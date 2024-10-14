<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{MenuCategory, MenuSubcategory};

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = MenuCategory::paginate(10);
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'image' => 'nullable'
        ]);

        if($request->hasFile('image')) {
            $validatedData['image'] = fileUpload($request->image, 'images/menu-categories');
        }

        $category = MenuCategory::create([
            'name' => $validatedData['name'],
            'image' => $validatedData['image'] ?? null,
        ]);

        return redirect()->route('menu-categories.index')->with('success', 'Category created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = MenuCategory::find($id);
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'image' => 'nullable'
        ]);

        $category = MenuCategory::find($id);

        if($request->hasFile('image')) {
            $validatedData['image'] = fileUpload($request->image, 'images/menu-categories');
        }

        $category->update([
            'name' => $validatedData['name'],
            'image' => $validatedData['image'] ?? null,
        ]);

        return redirect()->route('menu-categories.index')->with('success', 'Category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        MenuCategory::find($id)->delete();
        return redirect()->route('menu-categories.index')->with('success', 'Category deleted successfully!');
    }

    public function subcateogriesIndex($categoryId) {
        $data = MenuSubcategory::whereMenuCategoryId($categoryId)->paginate(10);
        return view('categories.subcategories-index', compact('data', 'categoryId'));
    }

    public function subcateogriesCreate($categoryId) {
        $data = Menucategory::all();
        return view('categories.subcategories-create', compact('data', 'categoryId'));
    }

    public function subcateogriesStore(Request $request) {
        $request->validate([
            'menu_category_id' => 'required',
            'name' => 'required',
        ]);

        MenuSubcategory::create($request->only('menu_category_id', 'name'));
        return redirect()->route('menu-items.subcateogries', $request->menu_category_id);
    }

    public function subcateogriesEdit($id) {
        $categories = Menucategory::all();
        $subcategory = MenuSubcategory::find($id);
        return view('categories.subcategories-edit', compact('subcategory', 'categories'));
    }

    public function subcateogriesUpdate(Request $request, $id) {
        $request->validate([
            'menu_category_id' => 'required',
            'name' => 'required',
        ]);

        MenuSubcategory::whereId($id)->update($request->only('menu_category_id', 'name'));
        return redirect()->route('menu-items.subcateogries', $request->menu_category_id);
    }

    public function subcateogriesDestroy(string $id)
    {
        MenuSubcategory::find($id)->delete();
        return redirect()->route('menu-subcategories.index')->with('success', 'Subcategory deleted successfully!');
    }
    
}
