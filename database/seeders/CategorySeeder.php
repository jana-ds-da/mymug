<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::firstOrCreate(['name' => 'Hot Chocolate', 'slug' => 'hot-chocolate']);
        Category::firstOrCreate(['name' => 'Espresso', 'slug' => 'espresso']);
        Category::firstOrCreate(['name' => 'Ice Coffee', 'slug' => 'ice-coffee']);
    }
}
