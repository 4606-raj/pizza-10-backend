<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MenuCategory;

class MenuItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'pizza 1', 'description' => 'description 1 is dummy description', 'price' => 100, 'menu_subcategories_id' => 1, 'is_veg' => true, 'max_allowed_toppings' => 10],
            ['name' => 'pizza 2', 'description' => 'description 2 is dummy description', 'price' => 100, 'menu_subcategories_id' => 1, 'is_veg' => true, 'max_allowed_toppings' => 10],
            ['name' => 'pizza 3', 'description' => 'description 3 is dummy description', 'price' => 100, 'menu_subcategories_id' => 1, 'is_veg' => true, 'max_allowed_toppings' => 10],
        ];

        $menuCategories = MenuCategory::all();
        
        foreach ($menuCategories as $key => $menuCategory) {
            foreach ($data as $key => $value) {
                $menuItem = $menuCategory->menuItems()->firstOrCreate($value);

                $menuItem->tags()->sync([1, 2, 3]);
            }
        }
        
    }
}
