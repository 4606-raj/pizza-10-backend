<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MenuSubcategory;

class MenuSubcategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = ['menu subcategory 1'];
        
        foreach ($data as $key => $value) {
            MenuSubCategory::firstOrCreate(['name' => $value, 'menu_categories_id' => 1]);
        }
    }
}
