<?php

namespace Tests\Feature\Services;

use App\Services\CurrencyService;
use Carbon\Carbon;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use PHPUnit\Framework\Attributes\Group;
use Symfony\Component\DomCrawler\Crawler;
use Tests\TestCase;

#[Group('real test')]
class CurrencyServiceFeatureTest extends TestCase
{
    protected $currencyService;
    protected function setUp(): void
    {
        parent::setUp();

        $this->currencyService = new CurrencyService();
    }

    /**
     * Test getting last twenty days of currency data
     */
    public function testGetLastTwentyDays()
    {
        $result = $this->currencyService->getLastTwentyDays();

        $this->assertIsArray($result);
        $this->assertNotEmpty($result);

        $firstItem = $result[0];
        $this->assertArrayHasKey('currency', $firstItem);
        $this->assertArrayHasKey('city', $firstItem);
        $this->assertArrayHasKey('price_buy', $firstItem);
        $this->assertArrayHasKey('price_sell', $firstItem);
        $this->assertArrayHasKey('date', $firstItem);
        $this->assertArrayHasKey('day', $firstItem);

        $this->assertContains('Sanaa', array_column($result, 'city'));
        $this->assertContains('Aden', array_column($result, 'city'));

        $this->assertContains('USD', array_column($result, 'currency'));
        $this->assertContains('SAR', array_column($result, 'currency'));
    }

    /**
     * Test getting today's currencies
     */
    public function testGetTodayCurrencies()
    {
        $result = $this->currencyService->getTodayCurrencies();

        // Assertions
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);

        // Should only return today's data for Sanaa and Aden
        // In our sample, there are 4 entries for today (2 cities x 2 currencies)
        $todayDate = Carbon::today()->format('Y-m-d');
        $todayItems = array_filter($result, function ($item) use ($todayDate) {
            return $item['date'] === $todayDate;
        });


        // Check that we have both cities
        $cities = array_column($todayItems, 'city');
        $this->assertContains('Sanaa', $cities);
        $this->assertContains('Aden', $cities);

        // Check that we have both currencies
        $currencies = array_column($todayItems, 'currency');
        $this->assertContains('USD', $currencies);
        $this->assertContains('SAR', $currencies);
    }
}
