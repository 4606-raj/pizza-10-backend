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
            ['title' => 'offer 1', 'code' => 'offer-1', 'description' => 'offer 1 is dummy offer'],
            ['title' => 'offer 2', 'code' => 'offer-2', 'description' => 'offer 2 is dummy offer'],
            ['title' => 'offer 3', 'code' => 'offer-3', 'description' => 'offer 3 is dummy offer'],
        ];

        $offerCategories = OfferCategory::all();
        
        foreach ($offerCategories as $key => $offerCategory) {
            foreach ($data as $key1 => $value) {
                if($key == 0 && $key1 > 0) {
                    continue;
                }
                $offerCategory->offers()->firstOrCreate($value);
            }
        }

        Offer::first()->update(['image' => 'flat 50  off.png']);
        
    }
}
