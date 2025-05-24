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
        $saudiRial = Currency::factory()->saudiRial()->create();
        $usdDollar = Currency::factory()->usdDollar()->create();

        // cities
        $sanaa = City::factory()->sanaa()->create();
        $aden = City::factory()->aden()->create();

        // rates
        Rate::factory()->recycle($usdDollar)->recycle($sanaa)->create();
        Rate::factory()->recycle($usdDollar)->recycle($aden)->create();

        Rate::factory()->recycle($saudiRial)->recycle($sanaa)->create();
        Rate::factory()->recycle($saudiRial)->recycle($aden)->create();
    }
}
