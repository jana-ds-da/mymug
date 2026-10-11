<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductTranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            $translations = [

            1 => [
                'mug_name' => 'كوب بينك ريبون مصنوع يدويا',
                'description' => 'كوب سيراميك ساحر مصنوع يدويا بتفاصيل رقيقة ولمسة فنية مميزة.',
                'how_its_made' => 'مصنوع يدويا من سيراميك عالي الجودة، ومطلي يدويا ومزجج بعناية.',
            ],

            2 => [
                'mug_name' => 'كوب إسبريسو مزين بالفيونكة',
                'description' => 'كوب سيراميك ساحر مصنوع يدويا بتفاصيل رقيقة وتصميم أنيق.',
                'how_its_made' => 'مشكل يدويا، ومزين بفيونكات منحوتة، ثم مزجج ومشوي بعناية.',
            ],

            3 => [
                'mug_name' => 'طقم كوب وصحن كلاسيكي بالفيونكة',
                'description' => 'طقم كوب وصحن مصنوع يدويا بتصميم أنيق وتفاصيل فنية مميزة.',
                'how_its_made' => 'مصنوع يدويا، ومطلي يدويا، ومزجج، ثم يتم حرقه في درجة حرارة عالية.',
            ],

            4 => [
                'mug_name' => 'كوب زهور كلاسيكي',
                'description' => 'كوب سيراميك أنيق بتصميم مستوحى من الزهور ولمسة كلاسيكية.',
                'how_its_made' => 'مشكل على عجلة الفخار، ومطلي يدويا بتصاميم زهرية، ثم مزجج ومشوي.',
            ],

            5 => [
                'mug_name' => 'كوب لافندر ريفي',
                'description' => 'كوب حجري ريفي بتصميم هادئ وتفاصيل مستوحاة من الطبيعة.',
                'how_its_made' => 'مصنوع يدويا من الفخار الحجري، ومطلي يدويا، ثم مزجج ومشوي.',
            ],

            6 => [
                'mug_name' => 'كوب حبوب القهوة',
                'description' => 'كوب سيراميك مميز بتفاصيل مستوحاة من حبوب القهوة.',
                'how_its_made' => 'مصنوع من السيراميك يدويا مع تشكيل حبوب القهوة بشكل منفصل وإضافتها بعناية.',
            ],

            7 => [
                'mug_name' => 'طقم كوب وصحن دريم إت',
                'description' => 'طقم كوب وصحن أنيق بتفاصيل بارزة وتصميم مميز.',
                'how_its_made' => 'مصنوع يدويا، مع نقش التفاصيل قبل الحرق، ثم مزجج بطبقة ناعمة.',
            ],

            8 => [
                'mug_name' => 'كوب فخار حجري على شكل قلب',
                'description' => 'كوب فخار حجري أنيق بتفاصيل ناعمة وتصميم مستوحى من القلب.',
                'how_its_made' => 'مشكل على عجلة الفخار، ومشطب يدويا، ثم مزجج ومشوي في درجة حرارة عالية.',
            ],

            9 => [
                'mug_name' => 'كوب بتدرج وردي',
                'description' => 'كوب مصنوع يدويا بتدرجات لونية ناعمة ولمسة عصرية.',
                'how_its_made' => 'مصنوع يدويا باستخدام تقنيات متعددة من التزجيج لإنشاء تدرج لوني مميز.',
            ],

            10 => [
                'mug_name' => 'طقم إسبريسو من الفخار الحجري',
                'description' => 'طقم إسبريسو أنيق بتصميم بسيط ولمسة طبيعية.',
                'how_its_made' => 'مشكل يدويا، ومزجج بتشطيب طبيعي من الفخار الحجري.',
            ],

        ];
         foreach ($translations as $productId => $translation) {

            $product = Product::find($productId);

            if ($product) {
                $product->translateOrNew('ar')->mug_name = $translation['mug_name'];
                $product->translateOrNew('ar')->description = $translation['description'];
                $product->translateOrNew('ar')->how_its_made = $translation['how_its_made'];

                $product->save();
        }
    }
}

}
