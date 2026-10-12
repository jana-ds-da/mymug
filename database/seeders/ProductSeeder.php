<?php

namespace Database\seeders;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\DB;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   

        $hotChocolate = Category::where('slug', 'hot-chocolate')->first();
        $espresso = Category::where('slug', 'espresso')->first();
        $iceCoffee = Category::where('slug', 'ice-coffee')->first();

        $products = [
           [ 
            'mug_name' => 'Pink Ribbon Handmade Mug',
            'price' => 950,
            'category_id' => $hotChocolate->id,
            'image_path' => 'img/mug1.jpeg',
            'description' => 'A charming handcrafted ceramic mug featuring delicate pink ribbon patterns, a sculpted bow, and elegant gold detailing',
            'capacity' => '350 ml',
            'how_its_made' => 'Handmade from high-quality ceramic, hand-painted, glazed, and kiln-fired with gold accents.',
            'microwave' => false,
          ],

          [
            'mug_name' => 'Bow Espresso Mug',
            'price' => 950,
            'category_id' => $espresso->id,
            'image_path' => 'img/mug2.jpeg',
            'description' => 'A charming handcrafted ceramic mug featuring delicate pink ribbon patterns, a sculpted bow, and elegant gold detailing.',
            'capacity' => '180 ml',
            'how_its_made' => 'Hand-shaped, detailed with sculpted bows, glazed, and kiln-fired',
            'microwave' => false,
        ],


       [
            'mug_name' => 'Classic Bow Cup & Saucer Set',
            'price' => 850,
            'category_id' => $hotChocolate->id,
            'image_path' => 'img/mug3.jpeg',
            'description' => 'A charming handcrafted ceramic mug featuring delicate pink ribbon patterns, a sculpted bow, and elegant gold detailing.',
            'capacity' => '250 ml',
            'how_its_made' => 'Handmade, hand-painted, glazed, and fired at high temperature.',
            'microwave' => false,
        ],


       [
            'mug_name' => 'Vintage Floral Mug',
            'price' => 750,
            'category_id' => $espresso->id,
            'image_path' => 'img/mug4.jpeg',
            'description' => 'A charming handcrafted ceramic mug featuring delicate pink ribbon patterns, a sculpted bow, and elegant gold detailing',
            'capacity' => '280 ml',
            'how_its_made' => 'Wheel-thrown, hand-painted with floral designs, glazed, and kiln-fired.',
            'microwave' => true,
        ],


         [
            'mug_name' => 'Lavender Rustic Mug',
            'price' => 720,
            'category_id' => $iceCoffee->id,
            'image_path' => 'img/mug5.jpeg',
            'description' => 'A charming handcrafted ceramic mug featuring delicate pink ribbon patterns, a sculpted bow, and elegant gold detailing.',
            'capacity' => '300 ml',
            'how_its_made' => 'Handcrafted from stoneware, hand-painted, glazed, and fired in a kiln.',
            'microwave' => true,
        ],


       [
            'mug_name' => 'Coffee Bean Mug',
            'price' => 650,
            'category_id' => $espresso->id,
            'image_path' => 'img/mug6.jpeg',
            'description' => 'A charming handcrafted ceramic mug featuring delicate pink ribbon patterns, a sculpted bow, and elegant gold detailing.',
            'capacity' => '320 ml',
            'how_its_made' => 'Handmade ceramic with individually sculpted coffee bean details and glossy glaze.',
            'microwave' => true,
        ],

        [
            'mug_name' => 'Dream It Mug & Saucer Set',
            'price' => 850,
            'category_id' => $hotChocolate->id,
            'image_path' => 'img/mug7.jpeg',
            'description' => 'A charming handcrafted ceramic mug featuring delicate pink ribbon patterns, a sculpted bow, and elegant gold detailing.',
            'capacity' => '300 ml',
            'how_its_made' => 'Handmade, embossed before firing, glazed with a smooth matte finish.',
            'microwave' => true,
        ],


        [
            'mug_name' => 'Heart Stoneware Mug',
            'price' => 970,
            'category_id' => $iceCoffee->id,
            'image_path' => 'img/mug8.jpeg',
            'description' => 'A charming handcrafted ceramic mug featuring delicate pink ribbon patterns, a sculpted bow, and elegant gold detailing.',
            'capacity' => '400 ml',
            'how_its_made' => 'Wheel-thrown, hand-finished, glazed, and fired at high temperature.',
            'microwave' => true,
        ],


       [
            'mug_name' => 'Blush Gradient Mug',
            'price' => 700,
            'category_id' => $iceCoffee->id,
            'image_path' => 'img/mug9.jpeg',
            'description' => 'A charming handcrafted ceramic mug featuring delicate pink ribbon patterns, a sculpted bow, and elegant gold detailing.',
            'capacity' => '350 ml',
            'how_its_made' => 'Handmade with layered glaze techniques to create the gradient effect.',
            'microwave' => true,
        ],


       [
            'mug_name' => 'Stoneware Espresso Set',
            'price' => 600,
            'category_id' => $espresso->id,
            'image_path' => 'img/mug10.jpeg',
            'description' => 'A charming handcrafted ceramic mug featuring delicate pink ribbon patterns, a sculpted bow, and elegant gold detailing.',
            'capacity' => '120 ml',
            'how_its_made' => 'Hand-shaped, glazed with a natural stoneware finish, and kiln-fired.',
            'microwave' => true,
        ],
    ];
            foreach ($products as $data) {
           
            $id = DB::table('products')->insertGetId($data + [
                'created_at' => now(),
                'updated_at' => now(),
            ]);

           
            $product = Product::find($id);
            $product->translateOrNew('en')->mug_name = $data['mug_name'];
            $product->translateOrNew('en')->description = $data['description'];
            $product->translateOrNew('en')->how_its_made = $data['how_its_made'];
            $product->save();
        }
    }
}
      

