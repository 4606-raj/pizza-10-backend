<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Staff;
use Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Staff::firstOrCreate([
            'name' => 'Raj',
            'email' => 'admin@gmail.com',
            'password' => Hash::make(123456789),
            'role' => 1
        ]);
    }
}
