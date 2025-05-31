<?php

namespace Tests\Feature;

use App\Models\City;
use App\Models\Currency;
use App\Models\Rate;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RateControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_displays_rates()
    {
        $sanaa = City::factory()->sanaa()->create();
        $aden = City::factory()->aden()->create();
        $unsupportedCity = City::factory()->create(['name' => 'taiz']);

        $usd = Currency::factory()->create(['code' => 'USD']);
        $sar = Currency::factory()->create(['code' => 'SAR']);

        // Sanaa rates
        $sanaaOldSaudiRate = Rate::factory()
            ->create([
                'city_id' => $sanaa->id,
                'currency_id' => $sar->id,
                'date' => now()->subDay(),
                'buy_price' => 139,
                'sell_price' => 140
            ]);

        $sanaaLatestSaudiRate = Rate::factory()
            ->create([
                'city_id' => $sanaa->id,
                'currency_id' => $sar->id,
                'date' => now(),
                'buy_price' => 140,
                'sell_price' => 141
            ]);

        $sanaaOldDollarRate = Rate::factory()
            ->create([
                'city_id' => $sanaa->id,
                'currency_id' => $usd->id,
                'date' => now()->subDay(),
                'buy_price' => 251,
                'sell_price' => 256
            ]);

        $sanaaLatestDollarRate = Rate::factory()
            ->create([
                'city_id' => $sanaa->id,
                'currency_id' => $usd->id,
                'date' => now(),
                'buy_price' => 256,
                'sell_price' => 261
            ]);

        // Aden rates
        $adenOldSaudiRate = Rate::factory()->create([
            'city_id' => $aden->id,
            'currency_id' => $sar->id,
            'date' => now()->subDay(),
            'buy_price' => 300,
            'sell_price' => 305
        ]);
        $adenLatestSaudiRate = Rate::factory()->create([
            'city_id' => $aden->id,
            'currency_id' => $sar->id,
            'date' => now(),
            'buy_price' => 305,
            'sell_price' => 310
        ]);
        $adenOldDollarRate = Rate::factory()->create([
            'city_id' => $aden->id,
            'currency_id' => $usd->id,
            'date' => now()->subDay(),
            'buy_price' => 2222,
            'sell_price' => 2227
        ]);
        $adenLatestDollarRate = Rate::factory()->create([
            'city_id' => $aden->id,
            'currency_id' => $usd->id,
            'date' => now(),
            'buy_price' => 22223,
            'sell_price' => 22224
        ]);

        $unsupportedRate = Rate::factory()->create([
            'city_id' => $unsupportedCity->id,
            'currency_id' => $usd->id,
            'date' => now(),
            'buy_price' => 270,
            'sell_price' => 275
        ]);

        // Act
        $response = $this->get('/');

        // Assert
        $response->assertStatus(200)
            ->assertViewIs('rates')
            ->assertViewHas('rates');

        $viewData = $response->original->getData();

        $ratesCities = $viewData['rates']->pluck('city')->toArray(); 

        $this->assertContains($sanaa->label, $ratesCities);
        $this->assertContains($aden->label, $ratesCities);
        $this->assertNotContains($unsupportedCity->label, $ratesCities);

        $sanaaRates = $viewData['rates'][0]['rates'];
        $this->assertCount(2, $sanaaRates);
        $this->assertEquals($sanaaLatestDollarRate->buy_price, $sanaaRates[0]['buy_price']);
        $this->assertEquals($sanaaLatestDollarRate->sell_price, $sanaaRates[0]['sell_price']);
        $this->assertEquals($sanaaLatestSaudiRate->buy_price, $sanaaRates[1]['buy_price']);
        $this->assertEquals($sanaaLatestSaudiRate->sell_price, $sanaaRates[1]['sell_price']);

        $adenRates = $viewData['rates'][1]['rates'];
        $this->assertCount(2, $adenRates);
        $this->assertEquals($adenLatestDollarRate->buy_price, $adenRates[0]['buy_price']);
        $this->assertEquals($adenLatestDollarRate->sell_price, $adenRates[0]['sell_price']);
        $this->assertEquals($adenLatestSaudiRate->buy_price, $adenRates[1]['buy_price']);
        $this->assertEquals($adenLatestSaudiRate->sell_price, $adenRates[1]['sell_price']);
    }
}
