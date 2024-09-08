<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use App\Models\{Offer, OfferType, OfferCategory, MenuItem, Base};

class OfferController extends Controller
{
    public function index() {
        $offers = Offer::paginate(10);
        return view('offers.index', compact('offers'));
    }

    public function create() {
        $offerTypes = OfferType::all();
        $offerCategories = OfferCategory::all();
        return view('offers.create', compact('offerTypes', 'offerCategories'));
    }
    
    public function store(Request $request) {

        $validatedData = $request->validate([
            'title' => 'required|string',
            'code' => 'required|string',
            'description' => 'required|string',
            'offer_category_id' => 'required|exists:offer_categories,id',
            'offer_type_id' => 'required|exists:offer_types,id',
            'offer_value' => 'required|numeric',
            'condition' => 'required|string',
            'condition_value' => 'required|numeric',
            'condition_type' => 'required|string',
        ]);

        $offer = Offer::create([
            'title' => $validatedData['title'],
            'code' => $validatedData['code'],
            'description' => $validatedData['description'],
            'offer_category_id' => $validatedData['offer_category_id'],
            'offer_type_id' => $validatedData['offer_type_id'],
            'offer_value' => $validatedData['offer_value'],
            'condition' => $validatedData['condition'],
            'condition_value' => $validatedData['condition_value'],
            'condition_type' => $validatedData['condition_type'],
        ]);

        return redirect()->route('offers.index')->with('success', 'Offer created successfully!');
    }

    public function edit(Offer $offer) {
        $offerTypes = OfferType::all();
        $offerCategories = OfferCategory::all();

        return view('offers.edit', compact('offerTypes', 'offerCategories', 'offer'));
    }

    public function update(Request $request, Offer $offer) {
        $validatedData = $request->validate([
            'title' => 'required|string',
            'code' => 'required|string',
            'description' => 'required|string',
            'offer_category_id' => 'required|exists:offer_categories,id',
            'offer_type_id' => 'required|exists:offer_types,id',
            'offer_value' => 'required|numeric',
            'condition' => 'required|string',
            'condition_value' => 'required|numeric',
            'condition_type' => 'required|string',
        ]);
    
        $offer->update([
            'title' => $validatedData['title'],
            'code' => $validatedData['code'],
            'description' => $validatedData['description'],
            'offer_category_id' => $validatedData['offer_category_id'],
            'offer_type_id' => $validatedData['offer_type_id'],
            'offer_value' => $validatedData['offer_value'],
            'condition' => $validatedData['condition'],
            'condition_value' => $validatedData['condition_value'],
            'condition_type' => $validatedData['condition_type'],
        ]);
    
        return redirect()->route('offers.index')->with('success', 'Offer updated successfully!');
    }

    public function settingsPage($offerId) {
        $offer = Offer::findOrFail($offerId);
        $menuItems = MenuItem::all();
        $bases = Base::all();

        return view('offers.settings', compact('offer', 'menuItems', 'bases'));
    }

    public function settingsStore(Request $request) {

        $offer = Offer::find($request->offer_id);
        if ($request->has('base_ids') && !empty($request->base_ids)) {
        
            foreach ($request->base_ids as $key => $baseId) {
                $base = Base::find($baseId);
    
                if ($base) {
                    $menuItems = $base->menuItems;
    
                    foreach ($menuItems as $menuItem) {
                        $offer->menuItems()->attach($menuItem->id, ['base_id' => $baseId]);
                    }
                }
            }
        }

        if ($request->has('menu_item') && !empty($request->menu_item)) {
            foreach ($request->menu_item as $menuItem) {
                foreach ($menuItem['base_ids'] as $baseId) {
                    $offer->menuItems()->attach($menuItem['id'], ['base_id' => $baseId]);
                }
                
            }
        }
    }
    
}
