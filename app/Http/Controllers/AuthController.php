<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Actions\Fortify\CreateNewUser;
use Twilio\Rest\Client;
use App\Traits\ApiResponsesTrait;
use App\Models\User;
use DB, Auth;

class AuthController extends Controller
{
    use ApiResponsesTrait;
    
    function __construct(CreateNewUser $createNewUser) {
        $this->createNewUser = $createNewUser;
    }
    
    public function register(Request $request)
    {
        $request->validate([
            'phone_number' => 'required|digits:10',
        ]);

        $otp = rand(100000, 999999);
        // $otp = 111000;

        try {        
            // sent OTP
            $account_sid = getenv("TWILIO_SID");
            $auth_token = getenv("TWILIO_AUTH_TOKEN");
            $twilio_number = getenv("TWILIO_NUMBER");

            $client = new Client($account_sid, $auth_token);
            
            $client->messages->create('+91' . $request->phone_number, 
                    ['from' => $twilio_number, 'body' => 'Welcome to Pizza 10, Your OTP is ' . $otp] );
            
            $expires_at = now()->addMinutes(10);

            $user = User::updateOrCreate(['phone_number' => $request->phone_number], [
                'phone_number' => $request->phone_number,
                'otp' => $otp,
                'otp_expires_at' => $expires_at,
            ]);
            

            $this->sendOtp($request->phone_number, $otp);

            return $this->success($user, 'User created', 201);
        }
        catch(\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }

    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'phone_number' => 'required|digits:10',
            'otp' => 'required|digits:6',
        ]);

        $user = User::where('phone_number', $request->phone_number)
                    ->where('otp', $request->otp)
                    // ->where('otp_expires_at', '>', now())
                    ->first();

        if(!$user) {
            return $this->error('Invalid Phone Number.', 404);
        }

        $token = $user->createToken('MyApp')->accessToken;
        
        // if ($user) {
            $user->update(['otp' => null, 'otp_expires_at' => null]);
            $user['token'] = $token;
            return $this->success($user, 'Welcome');
        // }

        return $this->error('Invalid OTP or OTP expired.', 401);
    }

    protected function sendOtp($phone_number, $otp)
    {
    }

    public function getProfile() {
        $data = Auth::user();

        return $this->success($data);
    }

    public function updateProfile(Request $request) {

        $user = Auth::user();
        
        $user->name = $request->name ?? $user->name;
        $user->email = $request->email ?? $user->email;
        // $user->phone_number = $request->phone_number ?? $user->phone_number;
        $user->gender = $request->gender ?? $user->gender;
        $user->update();

        return $this->success($user, "data updated successfully");
    }

}
