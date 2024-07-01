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
        $data = [
            ['name' => 'Flat out', 'image' => 'category-1.jpeg'],
            ['name' => 'Personal slice pizza', 'image' => 'category-2.jpeg'],
            ['name' => 'Veg pizza', 'image' => 'category-3.jpeg'],
            ['name' => 'Non-veg pizza', 'image' => 'category-4.jpeg'],
            ['name' => 'Clissic Pizzas for classic maniacs', 'image' => null],
            ['name' => 'Slides', 'image' => 'category-6.jpeg'],
            ['name' => 'Match day combos', 'image' => null],
            ['name' => 'Desert & Beverages', 'image' => null],
        ];
        
        foreach ($data as $key => $value) {
            MenuCategory::firstOrCreate($value);
        }
    }
}
