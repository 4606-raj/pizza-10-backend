<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use App\Models\{Offer, OfferType, OfferCategory, MenuItem, Base, MenuCategory};

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
            'image' => 'nullable|file:mime_type:jpeg,jpg,png',
            'upto' => 'nullable',
        ]);

        if($request->hasFile('image')) {
            $validatedData['image'] = fileUpload($request->image, 'images/offers');
        }

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
            'image' => $validatedData['image'] ?? null,
            'upto' => $validatedData['upto'] ?? null,
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
            'image' => 'nullable|file:mime_type:jpeg,jpg,png',
            'upto' => 'nullable',
        ]);

        if($request->hasFile('image')) {
            $validatedData['image'] = fileUpload($request->image, 'images/offers');
        }
    
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
            'image' => $validatedData['image'] ?? null,
            'upto' => $validatedData['upto'] ?? null,
        ]);
    
        return redirect()->route('offers.index')->with('success', 'Offer updated successfully!');
    }

    public function settingsPage($offerId) {
        $offer = Offer::findOrFail($offerId);
        $menuItems = MenuItem::all();
        $bases = Base::all();
        $menuCategories = MenuCategory::all();

        $offerMenuItems = $offer->MenuItems()->withPivot('base_id')->paginate(10);

        return view('offers.settings', compact('offer', 'menuItems', 'bases', 'offerMenuItems', 'menuCategories'));
    }

    public function settingsStore(Request $request) {

        $offer = Offer::find($request->offer_id);
        if ($request->has('base_ids') && !empty($request->base_ids)) {
            foreach ($request->base_ids as $key => $baseId) {
                $base = Base::find($baseId);
        
                if ($base) {
                    $menuItems = $base->menuItems;
        
                    foreach ($menuItems as $menuItem) {
                        $existingPivot = $offer->menuItems()->wherePivot('menu_item_id', $menuItem->id)->wherePivot('base_id', $baseId)->first();
                        if (!$existingPivot) {
                            $offer->menuItems()->attach($menuItem->id, ['base_id' => $baseId]);
                        }
                    }
                }
            }
        }

        if ($request->has('menu_categary_id') && !empty($request->menu_categary_id)) {
            $menuCategory = MenuCategory::find($request->menu_categary_id);
    
            if ($menuCategory) {
                $menuItems = $menuCategory->menuItems()->with('bases')->get();

                foreach ($menuItems as $menuItem) {
                    foreach ($menuItem->bases as $base) {
                        $existingPivot = $offer->menuItems()->wherePivot('menu_item_id', $menuItem->id)->wherePivot('base_id', $base->id)->first();
                        if (!$existingPivot) {
                            $offer->menuItems()->attach($menuItem->id, ['base_id' => $base->id]);
                        }
                    }
                }
            }
        }

        if ($request->has('menu_item') && !empty($request->menu_item)) {
            foreach ($request->menu_item as $menuItem) {
                foreach ($menuItem['base_ids'] as $baseId) {
                    // $offer->menuItems()->attach($menuItem['id'], ['base_id' => $baseId]);
                    // $offer->menuItems()->sync([$menuItem['id'] => ['base_id' => $baseId]]);

                    $existingPivot = $offer->menuItems()->wherePivot('menu_item_id', $menuItem['id'])->wherePivot('base_id', $baseId)->first();
                    if (!$existingPivot) {
                        $offer->menuItems()->attach($menuItem['id'], ['base_id' => $baseId]);
                    }
                }
                
            }
        }

        return redirect()->back();
    }

    public function settingsRemoveMenuItem($offerId, $menuItemId, $baseId) {
        $offer = Offer::findOrFail($offerId);

        $offer->menuItems()->wherePivot('base_id', $baseId)->detach($menuItemId);

        return redirect()->back()->with('succuss', 'Menu Item removed from offer');
    }

    public function settingsRemoveAllMenuItem($offerId) {
        $offer = Offer::findOrFail($offerId);

        $offer->menuItems()->detach();

        return redirect()->back()->with('succuss', 'Menu Item removed from offer');
    }
    
}
