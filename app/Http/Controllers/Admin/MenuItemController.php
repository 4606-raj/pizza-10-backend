<?php
// File: app/Http/Controllers/MenuItemController.php

namespace App\Http\Controllers\Admin;

use App\Models\{MenuItem, MenuCategory, Base, MenuSubcategory};
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Str, Hash;

class MenuItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menuItems = MenuItem::latest();
        $categories = MenuCategory::all();

        if(request()->has('menu_category_id') && !empty(request()->menu_category_id)) {
            $menuItems = $menuItems->whereMenuCategoryId(request()->menu_category_id);
        }

        if(request()->has('is_veg') && (request()->is_veg == 0 || request()->is_veg == 1)) {
            $menuItems = $menuItems->whereIsVeg(request()->is_veg);
        }

        $menuItems = $menuItems->paginate(10);
        
        return view('menu_items.index', compact('menuItems', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menuCategories = MenuCategory::all();
        $menuSubcategories = MenuSubcategory::all();
        $menuItems = MenuItem::all();
        $bases = Base::all();
        return view('menu_items.create', compact('menuCategories', 'bases', 'menuSubcategories', 'menuItems'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required|image',
            'description' => 'required',
            'menu_category_id' => 'required|integer',
            'menu_subcategory_id' => 'nullable|integer',
            'is_veg' => 'required|boolean',
            'prices.*' => 
                            function ($attribute, $value, $fail) {
                                $prices = request()->input('prices');
                                if (count(array_filter($prices)) > 0) {
                                    return true;
                                }
                                $fail('At least one price is required');
                            },
                            'numeric',
        ]);

        $menuItem = new MenuItem();
        $menuItem->name = $request->input('name');
        $menuItem->image = fileUpload($request->file('image'), 'images/menu-items');

        $menuItem->description = $request->input('description');
        $menuItem->menu_category_id = $request->input('menu_category_id');
        $menuItem->menu_subcategory_id = $request->input('menu_subcategory_id');
        $menuItem->is_veg = $request->input('is_veg');
        $menuItem->save();

        $prices = array_filter($request->prices);
        
        foreach ($prices as $baseId => $price) {
            // dd($prices);
            $menuItem->prices()->create([
                'base_id' => $baseId,
                'menu_item_id' => $menuItem->id,
                'price' => $price
            ]);
        }

        return redirect()->route('menu-items.index')->with('success', 'Menu item created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $menuItem = MenuItem::find($id);
        return view('menu_items.show', compact('menuItem'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menuItem = MenuItem::find($id);
        $menuCategories = MenuCategory::all();
        $menuSubcategories = MenuSubcategory::all();
        $bases = Base::all();
        return view('menu_items.edit', compact('menuItem', 'menuCategories', 'bases', 'menuSubcategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'menu_category_id' => 'required|integer',
            'menu_subcategory_id' => 'nullable|integer',
            'is_veg' => 'required|boolean',
        ]);

        $menuItem = MenuItem::find($id);
        $menuItem->name = $request->input('name');
        if ($request->hasFile('image')) {
            $menuItem->image = fileUpload($request->file('image'), 'images/menu-items');
        }
        $menuItem->description = $request->input('description');
        $menuItem->menu_category_id = $request->input('menu_category_id');
        $menuItem->menu_subcategory_id = $request->input('menu_subcategory_id');
        $menuItem->is_veg = $request->input('is_veg');
        $menuItem->save();

        foreach ($request->prices as $baseId => $price) {
            $menuItem->prices()->where([
                'base_id' => $baseId,
                'menu_item_id' => $menuItem->id,
            ])->update([
                'price' => $price
            ]);
        }

        return redirect()->route('menu-items.index')->with('success', 'Menu item updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menuItem = MenuItem::find($id);
        $menuItem->delete();

        return redirect()->route('menu-items.index')->with('success', 'Menu item deleted successfully!');
    }

    public function menuItemsCategoryAttach(Request $request) {
        $request->validate([
            'menu_category_id' => 'required',
            'menu_subcategory_id' => 'nullable',
            'menu_item_ids.*' => 'required',
        ]);

        $menuItems = MenuItem::find($request->menu_item_ids);

        foreach ($menuItems as $key => $value) {
            $value->update([
                'menu_category_id' => $request->menu_category_id,
                'menu_subcategory_id' => $request->menu_subcategory_id,
            ]);
        }

        return redirect()->route('menu-items.index');
    }
}