<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MenuCategory;

class MenuCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = ['Flat out', 'Personal slice pizza', 'Veg pizza', 'Non-veg pizza', 'Clissic Pizzas for classic maniacs', 'Slides', 'Match day combos', 'Desert & Beverages'];
        
        foreach ($data as $key => $value) {
            MenuCategory::firstOrCreate(['name' => $value]);
        }
    }
}
