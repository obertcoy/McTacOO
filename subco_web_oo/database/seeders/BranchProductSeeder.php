<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BranchProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $branches = Branch::all();
        $products = Product::all();

        foreach ($branches as $branch) {

            foreach ($products as $product) {
                DB::table('branch_products')->updateOrInsert(
                    ['branch_id' => $branch->id, 'product_id' => $product->id],
                    ['quantity' => 16]
                );
            }
        }    }
}
