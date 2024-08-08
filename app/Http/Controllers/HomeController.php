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
    
    public function menu() : JsonResponse {
        $data = MenuItem::query();

        if(request()->has('menu_category_id') && !empty(request()->menu_category_id)) {
            $data = $data->whereMenuCategoryId(request()->menu_category_id);
        }

        if(request()->has('search') && !empty(request()->search)) {
            $data = $data->where(function($query) {
                $query->where('name', 'like', "%" . request()->search . "%")
                        ->orWhere('description', 'like', "%" . request()->search . "%");
            });
        }

        if(request()->veg && request()->nonveg) {
            $data = $data->whereIn('is_veg', [1, 2]);
        }

        $data = $data->get();
        return $this->success($data);
    }

    public function show($id) : JsonResponse {
        $data['menuItem'] = MenuItem::find($id);
        $data['toppings'] = ToppingCategory::with('toppings', 'prices')->get();
        return $this->success($data);
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

    function updateAddress(Request $request) : JsonResponse {
        $data = $request->validate([
                    'id' => 'required',
                    'house_no' => 'required',
                    'street_landmark' => 'required',
                    'sector_village' => 'required',
                    'city' => 'required',
                    'state' => 'required',
                    'details' => 'required',
                ]);
        
        $address = Address::whereId($data['id'])->update($data);

        return $this->success($address, 'Address Updated Successfully');
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
