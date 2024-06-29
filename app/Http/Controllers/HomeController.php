<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Traits\ApiResponsesTrait;
use App\Models\MenuCategory;
use App\Models\MenuItem;
use App\Models\OfferCategory;

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
    
}
