<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\OfferCategory;
use App\Models\Offer;

class OffersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['title' => 'Buy 1 Get 1 Medium', 'code' => 'get-1-medium', 'description' => 'Buy 1 Get 1 Medium', 'image' => '1+1-medium.png'],
            ['title' => 'Buy 1 Get 1 Large', 'code' => 'get-1-large', 'description' => 'Buy 1 Get 1 Large', 'image' => '1+1-large.jpeg'],
            ['title' => 'Buy 1 Get 1 Extra Large', 'code' => 'get-1-extra-large', 'description' => 'Buy 1 Get 1 Extra Large', 'image' => '1+1-extra-large.jpg'],
        ];

        $offerCategories = OfferCategory::limit(1)->get();
        
        foreach ($offerCategories as $key => $offerCategory) {
            foreach ($data as $key1 => $value) {
                // if($key == 0 && $key1 > 0) {
                //     continue;
                // }
                $offerCategory->offers()->firstOrCreate($value);
            }
        }

        // Offer::query()->update(['image' => 'flat 50  off.png']);
        
    }
}
