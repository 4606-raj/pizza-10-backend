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
        $menuCategories = [
            'MARGHERITA',
            'Veg Treat',
            'Sensation',
            'Indian Fusion',
            "P'Z 10 Special",
        ];

        foreach ($menuCategories as $menuCategoryName) {
            MenuCategory::firstOrCreate([
                'name' => $menuCategoryName,
                'image' => null,
            ]);
        }
    }
}
