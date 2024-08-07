<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Traits\ApiResponsesTrait;
use App\Models\{MenuItemPrice, Cart, CartAddon, ToppingCategoryPrice};
use Auth;

class CartController extends Controller
{
    use ApiResponsesTrait;
    
    public function index() : JsonResponse {
        $userId = Auth::user()->id;
        $data = Cart::with('toppings.topping:id,name', 'menuItem:id,name')->whereIn('status', [0, 1])->whereUserId($userId)->get();

        return $this->success($data);
    }
    
    public function store(Request $request) : JsonResponse {
        $data = $request->validate([
            'menu_item_id' => 'required',
            'base_id' => 'required',
        ]);

        $userId = Auth::user()->id;

        $amount = MenuItemPrice::whereMenuItemId($request->menu_item_id)->whereBaseId($request->base_id)->first();
        
        $cartItem = Cart::whereUserId($userId)->whereMenuItemId($request->menu_item_id)->whereBaseId($request->base_id)->whereIn('status', [0, 1])->first();

        if($cartItem) {
            $cartItem->increment('quantity');
            $cartItem->amount = $amount->price * $cartItem->quantity;
            $cartItem->save();
        }
        else {   
            $data['user_id'] = $userId;
            $data['amount'] = $amount->price;
            
            $cartItem = Cart::create($data);
        }

        if(!empty($request->toppings)) {

            foreach ($request->toppings as $key => $topping) {

                $toppingAmount = ToppingCategoryPrice::whereToppingCategoryId($topping['topping_category_id'])->whereBaseId($request->base_id)->value('price');
                
                $topping = CartAddon::create([
                    'cart_id' => $cartItem->id,
                    'addon_id' => $topping['id'],
                    'addon_type' => 'topping',
                    'amount' => $toppingAmount
                ]);
                
                $amount = $cartItem->amount + $topping->amount;
                $data['toppings'][] = $topping;
            }
            $cartItem->amount = $amount;
            $cartItem->save();
        }

        
        $data['cartItem'] = $cartItem;

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
