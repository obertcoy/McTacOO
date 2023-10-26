<?php

namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Branch::create([
            'name' => 'McTacOO Kemanggisan',
            'address' => 'Jl. Kemanggisan No 231',
        ]);

        Branch::create([
            'name' => 'McTacOO Palembang',
            'address' => 'Jl. Sekip Raya No 123',
        ]);

        Branch::create([
            'name' => 'McTacOO Puri',
            'address' => 'Jl. Puri Agung No 321',
        ]);

    }
}
