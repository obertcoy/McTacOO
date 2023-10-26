<?php

namespace Database\Seeders;

use App\Models\PacketProduct;
use Illuminate\Database\Seeder;

class PacketProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PacketProduct::create(
            ['packet_id' => 1,
            'product_id' => 1,
            'quantity' => 2],
        );

        PacketProduct::create(
            ['packet_id' => 1,
            'product_id' => 2,
            'quantity' => 1],
        );

        PacketProduct::create(
            ['packet_id' => 1,
            'product_id' => 3,
            'quantity' => 1],
        );

        PacketProduct::create(
            ['packet_id' => 2,
            'product_id' => 6,
            'quantity' => 2],
        );
        PacketProduct::create(
            ['packet_id' => 2,
            'product_id' => 7,
            'quantity' => 1],
        );

        PacketProduct::create(
            ['packet_id' => 3,
            'product_id' => 8,
            'quantity' => 2],
        );
        PacketProduct::create(
            ['packet_id' => 3,
            'product_id' => 9,
            'quantity' => 1],
        );
    }
}
