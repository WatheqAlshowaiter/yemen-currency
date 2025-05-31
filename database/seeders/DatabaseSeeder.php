<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Currency;
use App\Models\Rate;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // currencies
        $usdDollar = Currency::factory()->usdDollar()->create();
        $saudiRial = Currency::factory()->saudiRial()->create();

        // cities
        $sanaa = City::factory()->sanaa()->create();
        $aden = City::factory()->aden()->create();

        // we will seed rates with commands instead
    }
}
