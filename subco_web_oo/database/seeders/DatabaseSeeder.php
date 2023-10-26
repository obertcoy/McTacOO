<?php

namespace Database\Seeders;

use App\Models\BranchProduct;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(BranchSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(MembershipSeeder::class);
        $this->call(ProductTypeSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(PacketSeeder::class);
        $this->call(PacketProductSeeder::class);
        $this->call(PromoSeeder::class);
        $this->call(BranchProductSeeder::class);
        $this->call(PaymentSeeder::class);
    }
}
