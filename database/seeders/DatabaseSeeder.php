<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            MenuCategoriesSeeder::class,
            MenuSubcategoriesSeeder::class,
            OrderTypesSeeder::class,
            TagsSeeder::class,
            OfferCategoriesSeeder::class,
            OffersSeeder::class,
            MenuItemsSeeder::class,
            BaseCategoriesSeeder::class,
            BasesSeeder::class,
            DipsSeeder::class,
            ToppingCategoriesSeeder::class,
            ToppingsSeeder::class,
        ]);
    }
}
