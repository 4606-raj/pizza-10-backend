<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Dip;

class DipsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dips = [
            'Americano' => 30,
            'BBQ' => 30,
            'Ranch' => 30,
            'Sweet Jalapeno' => 30,
        ];

        foreach ($dips as $dipName => $price) {
            Dip::firstOrCreate([
                'name' => $dipName,
                'price' => $price,
            ]);
        }
    }
}
