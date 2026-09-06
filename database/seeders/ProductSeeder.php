<?php

namespace Database\seeders;
use App\Models\Product;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\seeder;

class ProductSeeder extends seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'mug_name' => 'Pink Ribbon Handmade Mug',
            'price' => 950,
            'category' => 'hot chocolate',
            'image_path' => 'products/public/storage/products/zS77AFE48LFBCzQRACOtufIBpVVzUERRi5ooYv6K.jpg',
            'description' => 'A charming handcrafted ceramic mug featuring delicate pink ribbon patterns, a sculpted bow, and elegant gold detailing',
            'capacity' => '350 ml',
            'how_its_made' => 'Handmade from high-quality ceramic, hand-painted, glazed, and kiln-fired with gold accents.',
            'microwave' => false,
        ]);

        Product::create([
            'mug_name' => 'Bow Espresso Mug',
            'price' => 950,
            'category' => 'espresso',
            'image_path' => 'img/mug2.jpg',
            'description' => 'A charming handcrafted ceramic mug featuring delicate pink ribbon patterns, a sculpted bow, and elegant gold detailing.',
            'capacity' => '180 ml',
            'how_its_made' => 'Hand-shaped, detailed with sculpted bows, glazed, and kiln-fired',
            'microwave' => false,
        ]);


        Product::create([
            'mug_name' => 'Classic Bow Cup & Saucer Set',
            'price' => 850,
            'category' => 'hot chocolate',
            'image_path' => 'img/mug3.jpg',
            'description' => 'A charming handcrafted ceramic mug featuring delicate pink ribbon patterns, a sculpted bow, and elegant gold detailing.',
            'capacity' => '250 ml',
            'how_its_made' => 'Handmade, hand-painted, glazed, and fired at high temperature.',
            'microwave' => false,
        ]);


        Product::create([
            'mug_name' => 'Vintage Floral Mug',
            'price' => 750,
            'category' => 'espresso',
            'image_path' => 'img/mug4.jpg',
            'description' => 'A charming handcrafted ceramic mug featuring delicate pink ribbon patterns, a sculpted bow, and elegant gold detailing',
            'capacity' => '280 ml',
            'how_its_made' => 'Wheel-thrown, hand-painted with floral designs, glazed, and kiln-fired.',
            'microwave' => true,
        ]);


         Product::create([
            'mug_name' => 'Lavender Rustic Mug',
            'price' => 720,
            'category' => 'ice coffee',
            'image_path' => 'img/mug5.jpg',
            'description' => 'A charming handcrafted ceramic mug featuring delicate pink ribbon patterns, a sculpted bow, and elegant gold detailing.',
            'capacity' => '300 ml',
            'how_its_made' => 'Handcrafted from stoneware, hand-painted, glazed, and fired in a kiln.',
            'microwave' => true,
        ]);


        Product::create([
            'mug_name' => 'Coffee Bean Mug',
            'price' => 650,
            'category' => 'espresso',
            'image_path' => 'img/mug6.jpg',
            'description' => 'A charming handcrafted ceramic mug featuring delicate pink ribbon patterns, a sculpted bow, and elegant gold detailing.',
            'capacity' => '320 ml',
            'how_its_made' => 'Handmade ceramic with individually sculpted coffee bean details and glossy glaze.',
            'microwave' => true,
        ]);

        Product::create([
            'mug_name' => 'Dream It Mug & Saucer Set',
            'price' => 850,
            'category' => 'hot chocolate',
            'image_path' => 'img/mug7.jpg',
            'description' => 'A charming handcrafted ceramic mug featuring delicate pink ribbon patterns, a sculpted bow, and elegant gold detailing.',
            'capacity' => '300 ml',
            'how_its_made' => 'Handmade, embossed before firing, glazed with a smooth matte finish.',
            'microwave' => true,
        ]);


        Product::create([
            'mug_name' => 'Heart Stoneware Mug',
            'price' => 970,
            'category' => 'ice coffee',
            'image_path' => 'img/mug8.jpg',
            'description' => 'A charming handcrafted ceramic mug featuring delicate pink ribbon patterns, a sculpted bow, and elegant gold detailing.',
            'capacity' => '400 ml',
            'how_its_made' => 'Wheel-thrown, hand-finished, glazed, and fired at high temperature.',
            'microwave' => true,
        ]);


        Product::create([
            'mug_name' => 'Blush Gradient Mug',
            'price' => 700,
            'category' => 'ice coffee',
            'image_path' => 'img/mug9.jpg',
            'description' => 'A charming handcrafted ceramic mug featuring delicate pink ribbon patterns, a sculpted bow, and elegant gold detailing.',
            'capacity' => '350 ml',
            'how_its_made' => 'Handmade with layered glaze techniques to create the gradient effect.',
            'microwave' => true,
        ]);


        Product::create([
            'mug_name' => 'Stoneware Espresso Set',
            'price' => 600,
            'category' => 'Espresso',
            'image_path' => 'img/mug10.jpg',
            'description' => 'A charming handcrafted ceramic mug featuring delicate pink ribbon patterns, a sculpted bow, and elegant gold detailing.',
            'capacity' => '120 ml',
            'how_its_made' => 'Hand-shaped, glazed with a natural stoneware finish, and kiln-fired.',
            'microwave' => true,
        ]);

        
    }
}
