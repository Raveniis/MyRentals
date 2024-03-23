<?php

namespace Database\Seeders;

use \App\Models\RentalReview;
use App\Models\TenantApplication;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RentalReviewSeeder::class,
            HouseRentalSeeder::class,
            TenantApplicationSeeder::class
        ]);
    }
}
