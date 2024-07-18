<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Actions\Fortify\CreateNewUser;
use App\Traits\ApiResponsesTrait;
use App\Models\User;
use DB;

class AuthController extends Controller
{
    use ApiResponsesTrait;
    
    function __construct(CreateNewUser $createNewUser) {
        $this->createNewUser = $createNewUser;
    }
    
    public function register(Request $request)
    {
        $request->validate([
            'phone_number' => 'required|digits:10|unique:users,phone_number',
        ]);

        // $otp = rand(100000, 999999);
        $otp = 111000;
        $expires_at = now()->addMinutes(10);

        $user = User::wherePhoneNumber($request->phone_number)->first();

        if(is_null($user)) {
            
            $user = User::create([
                'phone_number' => $request->phone_number,
                'otp' => $otp,
                'otp_expires_at' => $expires_at,
            ]);
        }
        

        $this->sendOtp($request->phone_number, $otp);

        return $this->success($user, 'User created', 201);
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

}
