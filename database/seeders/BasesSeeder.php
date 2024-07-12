<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Base;
use App\Models\BaseCategory;
use Illuminate\Database\Seeder;

class BasesSeeder extends Seeder
{
    public function run()
    {
        $defaultBaseCategory = BaseCategory::where('name', 'default')->first();

        if ($defaultBaseCategory) {
            $bases = [
                [
                    'name' => 'Regular',
                    'price' => 99,
                    'base_category_id' => $defaultBaseCategory->id,
                ],
                [
                    'name' => 'Medium',
                    'price' => 149,
                    'base_category_id' => $defaultBaseCategory->id,
                ],
                [
                    'name' => 'Large',
                    'price' => 199,
                    'base_category_id' => $defaultBaseCategory->id,
                ],
                [
                    'name' => 'Extra Large',
                    'price' => 269,
                    'base_category_id' => $defaultBaseCategory->id,
                ],
            ];

            foreach ($bases as $base) {
                Base::firstOrCreate([
                    'name' => $base['name'],
                    'price' => $base['price'],
                    'base_category_id' => $base['base_category_id'],
                ]);
            }
        }
    }
}
