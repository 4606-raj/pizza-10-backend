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
            OrderTypesSeeder::class,
            TagsSeeder::class,
            OfferCategoriesSeeder::class,
            OffersSeeder::class,
            BaseCategoriesSeeder::class,
            BasesSeeder::class,
            MenuItemsSeeder::class,
            DipsSeeder::class,
            ToppingCategoriesSeeder::class,
            ToppingsSeeder::class,
            AdminSeeder::class,
        ]);
    }
}
