<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\{Base, MenuItem};

class BaseMenuItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $baseIds = Base::all()->pluck('id');
        $menuItems = MenuItem::all();

        foreach ($menuItems as $key => $value) {
            $value->bases()->attach($baseIds);
        }
    }
}
