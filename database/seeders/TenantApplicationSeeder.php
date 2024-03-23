<?php

namespace Database\Seeders;

use App\Models\TenantApplication;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TenantApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TenantApplication::factory(10)->create();
    }
}
