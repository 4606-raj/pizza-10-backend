<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Traits\ApiResponsesTrait;
use App\Models\{Cart, Order};
use Auth;

class OrderController extends Controller
{
    use ApiResponsesTrait;

    public function store(Request $request) : JsonResponse {
        $input = $request->validate([
            'address_id' => 'required',
            'payment_mode' => 'required|in:cod',
        ]);

        $userId = Auth::user()->id;
        $cart = Cart::whereUserId($userId)->get();

        if(!count($cart)) {
            return $this->error('Your cart is emtpy', 403); 
        }

        $totalAmount = 0;
        
        foreach ($cart as $key => $value) {
            $totalAmount += $value->amount;
        }

        $data['address_id'] = $request->address_id;
        $data['payment_mode'] = $request->payment_mode;
        $data['user_id'] = $userId;
        $data['total_amount'] = $totalAmount;

        $order = Order::create($data);

        $order->cartItems()->sync($cart->pluck('id'));

        Cart::whereUserId($userId)->update(['status' => 2]);

        return $this->success();
    }

    public function index() : JsonResponse {
        $order = Order::with(['user', 'cartItems.menuItem'])->without('menuItem.prices')->get();

        return $this->success($order);
    }
}
