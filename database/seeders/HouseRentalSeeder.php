<?php

namespace Database\Seeders;

use App\Models\HouseRental;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HouseRentalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HouseRental::factory(10)->create();
    }
}
