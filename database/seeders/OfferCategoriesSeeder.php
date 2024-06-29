<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\OfferCategory;

class OfferCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = ['Bogo', 'Limited Offers', 'Top Offers',];
        
        foreach ($data as $key => $value) {
            OfferCategory::firstOrCreate(['name' => $value]);
        }
    }
}
