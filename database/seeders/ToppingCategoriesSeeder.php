<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ToppingCategory;
use App\Models\Base;
use App\Models\ToppingCategoryPrice;

class ToppingCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $toppingCategories = [
            ['name' => 'Veg',],
            ['name' => 'Non-Veg',],
            ['name' => 'Cheese',],
            ['name' => 'Free',],
        ];

        $bases = Base::all();

        foreach ($toppingCategories as $toppingCategory) {
            $toppingCategoryAdded = ToppingCategory::firstOrCreate([
                'name' => $toppingCategory['name'],
            ]);

            $prices = [
                [
                    'base_id' => $bases->where('name', 'Regular')->first()->id,
                    'price' => 40,
                ],
                [
                    'base_id' => $bases->where('name', 'Medium')->first()->id,
                    'price' => 60,
                ],
                [
                    'base_id' => $bases->where('name', 'Large')->first()->id,
                    'price' => 80,
                ],
                [
                    'base_id' => $bases->where('name', 'Extra Large')->first()->id,
                    'price' => 90,
                ],
            ];

            if ($toppingCategory['name'] === 'Non-Veg' || $toppingCategory['name'] === 'Cheese') {
                $prices[1]['price'] = 70;
                $prices[2]['price'] = 90;
                $prices[3]['price'] = 110;
            }
            else if ($toppingCategory['name'] === 'Free') {
                $prices[1]['price'] = 0;
                $prices[2]['price'] = 0;
                $prices[3]['price'] = 0;
            }

            foreach ($prices as $priceData) {
                ToppingCategoryPrice::firstOrCreate([
                    'topping_category_id' => $toppingCategoryAdded->id,
                    'base_id' => $priceData['base_id'],
                ], $priceData);
            }
        }
    }
}
