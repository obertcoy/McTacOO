<?php

namespace Database\Seeders;

use App\Models\Membership;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MembershipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Membership::insert([
            [
                'level' => 'Bronze',
                'required_points' => 1000
            ],
            [
                'level' => 'Silver',
                'required_points' => 5000
            ], [
                'level' => 'Gold',
                'required_points' => 15000
            ],
        ]);
    }
}
