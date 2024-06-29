<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = ['new', 'best-seller', 'trending'];

        foreach ($data as $key => $value) {
            Tag::firstOrCreate(['name' => $value]);
        }
    }
}
