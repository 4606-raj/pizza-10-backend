<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Traits\ApiResponsesTrait;
use App\Models\{MenuItemPrice, Cart, CartAddon, ToppingCategoryPrice, Offer};
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
            'offer_id' => 'nullable|exists:offers,id',
        ]);

        $userId = Auth::user()->id;

        $amount = MenuItemPrice::whereMenuItemId($request->menu_item_id)->whereBaseId($request->base_id)->first();
        
        $cart = Cart::whereUserId($userId)->whereIn('status', [0, 1])->first();

        if(empty($cart)) {
            $cart = Cart::create([
                'user_id' => $userId,
            ]);
        }
        
        $cartItem = $cart->menuItems()->wherePivot('menu_item_id', $request->menu_item_id)->wherePivot('base_id', $request->base_id)->withPivot('quantity')->first();
        
        if($cartItem) {
            $quantity = $cartItem->pivot->quantity + 1;
            $cart->menuItems()->updateExistingPivot($request->menu_item_id, ['amount' => $amount->price * $quantity, 'quantity' => $quantity]);

            $cart->total_amount = $amount->price * $quantity;
            $cart->total_quantity = $cart->menuItems()->sum('quantity');;
        }
        else {
            $cart->menuItems()->attach($request->menu_item_id, ['base_id' => $request->base_id, 'amount' => $amount->price, 'quantity' => 1]);

            $cart->total_amount = $amount->price;
            $cart->total_quantity = 1;
        }

        $cart->save();

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

        if($request->offer_id) {
            $cartItem = $this->handleOffer($request->offer_id);
        }
        
        $data['cartItem'] = $cartItem;

        return $this->success($data, "Added To Cart");
    }

    public function handleOffer($offerId) {
        $cart = Cart::whereStatus(0)->whereUserId(Auth::user()->id)->first();
        $offer = Offer::find($offerId);

        // Conditions

        $cartValue = $offer->condition_type == config('constants.offer_condition_types')[0]? $cart->amount: $cart->quantity;

        if($offer->condition == config('constants.offer_conditions')[0]) {
            if($offer->condition_value > $cartValue) {
                return $cart;
            }
        }

        else if($offer->condition == config('constants.offer_conditions')[1]) {
            if($offer->condition_value < $cartValue) {
                return $cart;
            }
        }

        else if($offer->condition == config('constants.offer_conditions')[2]) {
            if($offer->condition_value != $cartValue) {
                return $cart;
            }
        }
        
        // Flat Off
        if($offer->type->name == 'Flat Off') {
            $cart->amount = $cart->amount - $offer->value;
            $cart->save();
        }

        // Percent Off
        if($offer->type->name == 'Percent Off') {
            $offAmount = ($cart->amount / 100) * $offer->value;
            $cart->amount = $cart->amount - $offAmount;
            $cart->save();
        }
        // Buy One Get One
        if($offer->type->name == 'Buy One Get One') {
            $cart->amount = $cart->amount - $offAmount;
            $cart->save();
        }

        return $cart;
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
