<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $directory = public_path('/assets/product_seed');
        $imageFiles = File::files($directory);

        foreach ($imageFiles as $image) {

            Storage::put('images/' . $image->getFilename(), File::get($image));
        }

        Product::create([
            'name' => 'Fried Chicken',
            'type_id' => 1,
            'image' => 'images/fried_chicken.jpg',
            'price' => 9,
            'is_available' => true,
        ]);

        Product::create([
            'name' => 'Chicken Wrap',
            'type_id' => 1,
            'image' => 'images/chicken_wrap.jpg',
            'price' => 7,
            'is_available' => true,
        ]);

        Product::create([
            'name' => 'Taco',
            'type_id' => 2,
            'image' => 'images/taco.jpg',
            'price' => 6,
            'is_available' => true,
        ]);

        Product::create([
            'name' => 'Burrito',
            'type_id' => 2,
            'image' => 'images/burrito.webp',
            'price' => 6,
            'is_available' => true,
        ]);



        Product::create([
            'name' => 'French Fries',
            'type_id' => 3,
            'image' => 'images/french_fries.jpg',
            'price' => 5,
            'is_available' => true,
        ]);

        Product::create([
            'name' => 'Onion Rings',
            'type_id' => 3,
            'image' => 'images/onion_rings.jpg',
            'price' => 4,
            'is_available' => true,
        ]);

        Product::create([
            'name' => 'Chocolate Sundae',
            'type_id' => 4,
            'image' => 'images/chocolate_sundae.jpg',
            'price' => 3,
            'is_available' => true,
        ]);

        Product::create([
            'name' => 'Apple Pie',
            'type_id' => 4,
            'image' => 'images/apple_pie.jpg',
            'price' => 3,
            'is_available' => true,
        ]);

        Product::create([
            'name' => 'Ice Tea',
            'type_id' => 5,
            'image' => 'images/ice_tea.jpg',
            'price' => 2,
            'is_available' => true,
        ]);

        Product::create([
            'name' => 'Lychee Ice Tea',
            'type_id' => 5,
            'image' => 'images/lychee_ice_tea.jpg',
            'price' => 3,
            'is_available' => true,
        ]);

        Product::create([
            'name' => 'Soda',
            'type_id' => 6,
            'image' => 'images/soda.jpg',
            'price' => 3,
            'is_available' => true,
        ]);

        Product::create([
            'name' => 'Blue Soda',
            'type_id' => 6,
            'image' => 'images/blue_soda.jpg',
            'price' => 4,
            'is_available' => true,
        ]);


    }
}
