<?php

namespace Database\Seeders;

use App\Models\ProductType;
use Illuminate\Database\Seeder;

class ProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductType::create(['name' => 'Meal']);
        ProductType::create(['name' => 'Mexican']);
        ProductType::create(['name' => 'Snack']);
        ProductType::create(['name' => 'Dessert']);
        ProductType::create(['name' => 'Tea']);
        ProductType::create(['name' => 'Beverage']);

    }
}
