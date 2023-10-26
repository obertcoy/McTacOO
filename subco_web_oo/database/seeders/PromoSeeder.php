<?php

namespace Database\Seeders;

use App\Models\Promo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Carbon;

class PromoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $directory = public_path('/assets/promo_seed');
        $imageFiles = File::files($directory);

        foreach ($imageFiles as $image) {

            Storage::put('images/' . $image->getFilename(), File::get($image));
        }

        Promo::create([
            'name' => 'Discount 50% Off',
            'condition' => 'Discount 50% for Every Dessert Purchased with Cash!',
            'image' => 'images/off_50.avif',
            'end_date' => now()->addWeek(2)
        ]);

        Promo::create([
            'name' => 'Buy 1 Get 1',
            'condition' => 'Buy 1 Meal and Get a Free Snack of Your Choice!',
            'image' => 'images/buy1_get1.avif',
            'end_date' => now()->addWeek()
        ]);

        Promo::create([
            'name' => 'Special Offer',
            'condition' => 'Buy 2 Meal and Get 2 Soda Drinks!',
            'image' => 'images/special_offer.avif',
            'end_date' => now()->addDay(3)
        ]);
    }
}
