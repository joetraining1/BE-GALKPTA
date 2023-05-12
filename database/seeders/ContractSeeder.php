<?php

namespace Database\Seeders;

use App\Models\contract;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContractSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        contract::factory()
            ->count(1)
            ->create();
    }
}
