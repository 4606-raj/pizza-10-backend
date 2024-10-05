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
        $data = Cart::with('toppings.topping:id,name', 'menuItems:id,name')->whereIn('status', [0, 1])->whereUserId($userId)->get();

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

            $cart->total_amount = $cart->total_amount + $amount->price;
            $cart->total_quantity = ($cart->total_quantity ?? 0) + 1;
        }

        $cart->discounted_amount = $cart->total_amount;

        $cart->save();

        if(!empty($request->toppings)) {

            foreach ($request->toppings as $key => $topping) {

                $toppingAmount = ToppingCategoryPrice::whereToppingCategoryId($topping['topping_category_id'])->whereBaseId($request->base_id)->value('price');
                
                $topping = CartAddon::create([
                    'cart_id' => $cart->id,
                    'addon_id' => $topping['id'],
                    'addon_type' => 'topping',
                    'amount' => $toppingAmount
                ]);
                
                $amount = $cart->total_amount + $topping->amount;
                $data['toppings'][] = $topping;
            }
            $cart->total_amount = $amount;
            $cart->discounted_amount = $amount;
            $cart->save();
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

        $cartMenuItems = $cart->menuItems()->withPivot('base_id')->get();
        // dd($cartMenuItems);

        // menu item condition
        // foreach ($cartMenuItemIds as $key => $value) {
        //     $exists = $offer->menuItems()->whereMenuItemId($value->id)->wherePivot('base_id', $value->pivot->base_id)->exists();
        //     if($exists) {
        //         throw new \Exception("This offer is not applicable on selected pizzas");
        //     }
        // }

        // Conditions

        $cartValue = $offer->condition_type == config('constants.offer_condition_types')[0]? $cart->total_amount: $cart->total_quantity;

        if($offer->condition == config('constants.offer_conditions')[0]) {
            if($offer->condition_value < $cartValue) {
                return $cart;
            }
        }

        else if($offer->condition == config('constants.offer_conditions')[1]) {
            if($offer->condition_value > $cartValue) {
                return $cart;
            }
        }

        else if($offer->condition == config('constants.offer_conditions')[2]) {
            if($offer->condition_value != $cartValue) {
                return $cart;
            }
        }
        
        foreach ($cartMenuItems as $key => $cartMenuItem) {
            $exists = $offer->menuItems()->whereMenuItemId($cartMenuItem->id)->wherePivot('base_id', $cartMenuItem->pivot->base_id)->exists();
            if($exists) {
                
                // Flat Off
                if($offer->offerType->name == 'Flat Off') {

                    $cart->menuItems()->updateExistingPivot($cartMenuItem->id, ['amount' => $offer->offer_value]);
                    
                    $cart->offer_deduction = $cart->offer_deduction + $offer->offer_value;
                    $cart->discounted_amount = $cart->total_amount - $offer->offer_value;
                    $cart->save();
                }
                
                // Percent Off
                if($offer->offerType->name == 'Percent Off') {

                    $offAmount = ($cartMenuItem->pivot->amount / 100) * $offer->offer_value;

                    $cart->menuItems()->wherePivot('base_id', $cartMenuItem->pivot->base_id)->updateExistingPivot($cartMenuItem->id, ['amount' => $cartMenuItem->pivot->amount - $offAmount]);
                    
                    $cart->offer_deduction = $cart->offer_deduction + $offAmount;
                    $cart->discounted_amount = $cart->total_amount - $offAmount;
                    $cart->save();
                }
                // Buy One Get One
                if($offer->offerType->name == 'Buy One Get One') {
                    $cart->total_amount = $cart->total_amount - $offAmount;
                    $cart->save();
                }
                $cart->offer_id = $offer->id;
                $cart->save();
            }
        }

        return $cart;
    }

    public function destroy(Request $request) : JsonResponse {
        $data = $request->validate([
            'id' => 'required',
        ]);

        try {
            $cart = Cart::whereUserId(Auth::user()->id)->first();
            $cartItem = $cart->menuItems()->withPivot('quantity', 'amount', 'base_id')->get()->filter(function($menuItem) use ($request) {
                return $menuItem->id == $request->id;
            })[0];

            if($cartItem->pivot->quantity > 1) {
                $amount = MenuItemPrice::whereMenuItemId($cartItem->id)->whereBaseId($cartItem->pivot->base_id)->first();
                $cart->menuItems()->updateExistingPivot($request->id, ['quantity' => \DB::raw('quantity - 1')]);

                $decreasedAmount = $amount->price * ($cartItem->pivot->quantity - 1);
                $cart->menuItems()->updateExistingPivot($request->id, ['amount' => $decreasedAmount]);
                
                $cart->decrement('total_quantity');
                $cart->total_amount = $cart->total_amount - $amount->price;
                $cart->save();
            }
            else {
                $cart->menuItems()->detach();
                $cart->delete();
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

    public function applyOffer(Request $request) {
        try {

            $request->validate([
                'code' => 'required|exists:offers,code'
            ]);
            
            $offer = Offer::whereCode($request->code)->firstOrFail();
            
            $this->handleOffer($offer->id);
            return $this->index();
        }
        catch(\Exception $e) {
            return $this->error($e->getMessage(), 403);
        }
    }
}
