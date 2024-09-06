<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\OfferType;

class OfferTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'Buy One Get One'],
            ['name' => 'Percent Off'],
            ['name' => 'Flat Off'],
        ];

        foreach ($data as $item) {
            OfferType::firstOrCreate(['name' => $item['name']], $item);
        }
    }
}
