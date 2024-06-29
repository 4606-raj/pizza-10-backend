<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\OrderType;

class OrderTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = ['Dilevery', 'Pickup', 'Dine-In', 'In-Car'];
        
        foreach ($data as $key => $value) {
            OrderType::firstOrCreate(['name' => $value]);
        }
    }
}
