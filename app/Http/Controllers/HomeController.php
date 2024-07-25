<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Traits\ApiResponsesTrait;
use App\Models\MenuCategory;
use App\Models\MenuItem;
use App\Models\OfferCategory;
use App\Models\Address;
use App\Models\ToppingCategory;
use Auth;

class HomeController extends Controller
{

    use ApiResponsesTrait;
    
    public function index() : JsonResponse {
        $data['offers_categories'] = OfferCategory::with('offers')->get();
        
        $data['menu_categories'] = MenuCategory::all();
        $data['manu_items']['trending_items'] = MenuItem::filter('trending')->get();
        $data['manu_items']['best_seller'] = MenuItem::filter('best-seller')->get();
        $data['manu_items']['newly_added'] = MenuItem::filter('new')->get();

        return $this->success($data);

    }

    public function show($id) : JsonResponse {
        $menuItem = MenuItem::find($id);
        return $this->success($menuItem);
    }

    public function getAddresses() : JsonResponse {
        $data['addresses'] = Auth::user()->addresses;
        $data['defaultAddress'] = Auth::user()->defaultAddress[0] ?? null;

        return $this->error($data);
    }
    
    function storeAddress(Request $request) : JsonResponse {
        $data = $request->validate([
                    'house_no' => 'required',
                    'street_landmark' => 'required',
                    'sector_village' => 'required',
                    'city' => 'required',
                    'state' => 'required',
                    'details' => 'required',
                ]);

        $data['user_id'] = Auth::user()->id;
        
        $address = Address::create($data);

        return $this->success($address, 'Address Added Successfully');
    }

    public function destroyAddress($id) : JsonResponse {
        try {
            Address::findOrFail($id)->delete();

            return $this->success([], 'Address Deleted Successfully');
        }
        catch(\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function toppingsList() : JsonResponse {
        $data = ToppingCategory::with('toppings', 'prices')->get();
        return $this->success($data);
    }
}
