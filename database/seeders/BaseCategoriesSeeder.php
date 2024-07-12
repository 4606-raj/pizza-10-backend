<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\BaseCategory;
use Illuminate\Database\Seeder;

class BaseCategoriesSeeder extends Seeder
{
    public function run()
    {
        BaseCategory::firstOrCreate([
            'name' => 'default',
        ]);
    }
}
