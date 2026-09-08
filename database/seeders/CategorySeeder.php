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
        Category::create(['name' => 'Hot Chocolate', 'slug' => 'hot-chocolate']);
        Category::create(['name' => 'Espresso', 'slug' => 'espresso']);
        Category::create(['name' => 'Ice Coffee', 'slug' => 'ice-coffee']);
    }
}
