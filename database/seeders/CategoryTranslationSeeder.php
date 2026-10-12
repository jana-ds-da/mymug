<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoryTranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
        public function run(): void
    {
        $categories = [
            'hot-chocolate' => [
                'en' => 'Hot Chocolate',
                'ar' => 'شوكولاتة ساخنة',
            ],

            'espresso' => [
                'en' => 'Espresso',
                'ar' => 'إسبريسو',
            ],

            'ice-coffee' => [
                'en' => 'Ice Coffee',
                'ar' => 'قهوة مثلجة',
            ],
        ];

        foreach ($categories as $slug => $translations) {

            $category = Category::where('slug', $slug)->first();

            foreach ($translations as $locale => $name) {
               $t = $category->translateOrNew($locale);
               $t->name = $name;
               $t->save();
            }
        }
    }
}