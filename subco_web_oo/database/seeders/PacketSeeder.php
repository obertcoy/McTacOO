<?php

namespace Database\Seeders;

use App\Models\Packet;
use Illuminate\Database\Seeder;

class PacketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Packet::create(
            ['name' => 'Big Boy Lunch',
            'price' => 24],
        );

        Packet::create(
            ['name' => 'Little Kid Meal',
            'price' => 14],
        );

        Packet::create(
            ['name' => 'All Sweets',
            'price' => 16],
        );
    }
}
