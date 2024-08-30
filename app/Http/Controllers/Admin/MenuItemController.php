<?php
// File: app/Http/Controllers/MenuItemController.php

namespace App\Http\Controllers\Admin;

use App\Models\{MenuItem, MenuCategory, Base};
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
        $menuItems = MenuItem::latest()->paginate(10);
        return view('menu_items.index', compact('menuItems'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menuCategories = MenuCategory::all();
        $bases = Base::all();
        return view('menu_items.create', compact('menuCategories', 'bases'));
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
            'is_veg' => 'required|boolean',
            'prices.*' => 'required|numeric',
        ]);

        $menuItem = new MenuItem();
        $menuItem->name = $request->input('name');
        $menuItem->image = $request->file('image')->store(public_path('storage/images/menu-items'));

        $menuItem->description = $request->input('description');
        $menuItem->menu_category_id = $request->input('menu_category_id');
        $menuItem->is_veg = $request->input('is_veg');
        $menuItem->save();

        foreach ($request->prices as $baseId => $price) {
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
        $bases = Base::all();
        return view('menu_items.edit', compact('menuItem', 'menuCategories', 'bases'));
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
            'is_veg' => 'required|boolean',
        ]);

        $menuItem = MenuItem::find($id);
        $menuItem->name = $request->input('name');
        if ($request->hasFile('image')) {
            $menuItem->image = $request->file('image')->store('public/images');
        }
        $menuItem->description = $request->input('description');
        $menuItem->menu_category_id = $request->input('menu_category_id');
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
}