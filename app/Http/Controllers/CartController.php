<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Traits\ApiResponsesTrait;
use App\Models\{MenuItemPrice, Cart};
use Auth;

class CartController extends Controller
{
    use ApiResponsesTrait;
    
    public function index() : JsonResponse {
        $userId = Auth::user()->id;
        $data = Cart::with('menuItem:id,name')->whereUserId($userId)->get();

        return $this->success($data);
    }
    
    public function store(Request $request) : JsonResponse {
        $data = $request->validate([
            'menu_item_id' => 'required',
            'base_id' => 'required',
        ]);

        $userId = Auth::user()->id;

        $amount = MenuItemPrice::whereMenuItemId($request->menu_item_id)->whereBaseId($request->base_id)->first();
        
        $cartItem = Cart::whereUserId($userId)->whereMenuItemId($request->menu_item_id)->whereBaseId($request->base_id)->first();

        if($cartItem) {
            $cartItem->increment('quantity');
            $cartItem->amount = $amount->price * $cartItem->quantity;
            $cartItem->save();
        }
        else {   
            $data['user_id'] = $userId;
            $data['amount'] = $amount->price;
            
            Cart::create($data);
        }

        return $this->success($data, "Added To Cart");
    }

    public function destroy(Request $request) : JsonResponse {
        $data = $request->validate([
            'id' => 'required',
        ]);

        try {
            $cartItem = Cart::findOrFail($request->id);

            if($cartItem->quantity > 1) {
                $amount = MenuItemPrice::whereMenuItemId($cartItem->menu_item_id)->whereBaseId($cartItem->base_id)->first();
                $cartItem->decrement('quantity');
                $cartItem->amount = $amount->price * $cartItem->quantity;
                $cartItem->save();
            }
            else {
                $cartItem->delete();
            }
        }
        catch(\Exception $e) {
            return $this->error($e->getMessage());
        }

        return $this->success($data, "Removed From Cart");
    }

    public function increase(Request $request) : JsonResponse {
        $request->validate([
            'id' => 'required',
        ]);
        
        try {
            $cartItem = Cart::findOrFail($request->id);

            $amount = MenuItemPrice::whereMenuItemId($cartItem->menu_item_id)->whereBaseId($cartItem->base_id)->first();

            $cartItem->increment('quantity');
            $cartItem->amount = $amount->price * $cartItem->quantity;
            $cartItem->save();

            return $this->success($cartItem, "Added To Cart");
        }
        catch(\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
}
