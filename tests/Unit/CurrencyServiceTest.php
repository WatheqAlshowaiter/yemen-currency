<?php

namespace Tests\Unit;

use App\Services\CurrencyService;
use Illuminate\Support\Carbon;
use Mockery;
use Symfony\Component\BrowserKit\HttpBrowser;
use Symfony\Component\DomCrawler\Crawler;
use Tests\TestCase;

class CurrencyServiceTest extends TestCase
{
    protected $currencyService;
    protected $mockHttpBrowser;

    protected function setUp(): void
    {
        parent::setUp();

        // Create a mock for HttpBrowser
        $this->mockHttpBrowser = Mockery::mock(HttpBrowser::class);

        // Create the service with mocked dependencies
        $this->currencyService = Mockery::mock(CurrencyService::class)
            ->makePartial()
            ->shouldAllowMockingProtectedMethods();

        // Configure the service to return our mock
        $this->currencyService->shouldAllowMockingProtectedMethods();

        $this->currencyService->shouldReceive('createHttpBrowser')
            ->andReturn($this->mockHttpBrowser);
    }

    public function testGetTodayCurrenciesFiltersForTodayAndCities()
    {
        // Sample data that includes today and past dates
        $today = Carbon::today()->format('Y-m-d');
        $yesterday = Carbon::yesterday()->format('Y-m-d');

        $testData = [
            [
                'currency' => 'USD',
                'city' => 'Sanaa',
                'price_buy' => 535.0,
                'price_sell' => 537.0,
                'date' => $today,
                'day' => Carbon::today()->format('l')
            ],
            [
                'currency' => 'SAR',
                'city' => 'Sanaa',
                'price_buy' => 139.8,
                'price_sell' => 140.2,
                'date' => $today,
                'day' => Carbon::today()->format('l')
            ],
            [
                'currency' => 'USD',
                'city' => 'Aden',
                'price_buy' => 2541.0,
                'price_sell' => 2556.0,
                'date' => $today,
                'day' => Carbon::today()->format('l')
            ],
            [
                'currency' => 'SAR',
                'city' => 'Aden',
                'price_buy' => 668.0,
                'price_sell' => 670.0,
                'date' => $today,
                'day' => Carbon::today()->format('l')
            ],
            [
                'currency' => 'USD',
                'city' => 'Sanaa',
                'price_buy' => 534.0,
                'price_sell' => 536.0,
                'date' => $yesterday,
                'day' => Carbon::yesterday()->format('l')
            ],
            [
                'currency' => 'USD',
                'city' => 'OtherCity',
                'price_buy' => 540.0,
                'price_sell' => 542.0,
                'date' => $today,
                'day' => Carbon::today()->format('l')
            ]
        ];

        // Create a new instance for this test
        $currencyService = Mockery::mock(CurrencyService::class)->makePartial();
        $currencyService->shouldReceive('getLastTwentyDays')
            ->once()
            ->andReturn($testData);

        // Test the method
        $result = $currencyService->getTodayCurrencies();

        // Should only include today's data for Sanaa and Aden
        $this->assertCount(4, $result);

        // Check that only Sanaa and Aden cities are included
        $cities = array_column($result, 'city');
        $this->assertContains('Sanaa', $cities);
        $this->assertContains('Aden', $cities);
        $this->assertNotContains('OtherCity', $cities);

        // Check that only today's data is included
        $dates = array_unique(array_column($result, 'date'));
        $this->assertCount(1, $dates);
        $this->assertEquals($today, $dates[0]);
    }

    public function testGetTodayCurrenciesHandlesExceptions()
    {
        // Create a subclass of CurrencyService for testing
        $currencyService = new class extends CurrencyService {
            // Override getLastTwentyDays to throw an exception
            public function getLastTwentyDays(): array
            {
                throw new \Exception('Test exception');
            }
        };

        // Test the method - this will call the real getTodayCurrencies which calls our overridden getLastTwentyDays
        $result = $currencyService->getTodayCurrencies();

        // Should return an empty array on exception
        $this->assertIsArray($result);
        $this->assertEmpty($result);
    }

    public function testGetTodayCurrenciesUsesRecentDataWhenTodayNotAvailable()
    {
        // Sample data that includes only past dates
        $yesterday = Carbon::yesterday()->format('Y-m-d');
        $twoDaysAgo = Carbon::yesterday()->subDay()->format('Y-m-d');

        $testData = [
            [
                'currency' => 'USD',
                'city' => 'Sanaa',
                'price_buy' => 534.0,
                'price_sell' => 536.0,
                'date' => $yesterday,
                'day' => Carbon::yesterday()->format('l')
            ],
            [
                'currency' => 'SAR',
                'city' => 'Sanaa',
                'price_buy' => 139.0,
                'price_sell' => 140.0,
                'date' => $yesterday,
                'day' => Carbon::yesterday()->format('l')
            ],
            [
                'currency' => 'USD',
                'city' => 'Aden',
                'price_buy' => 2540.0,
                'price_sell' => 2555.0,
                'date' => $yesterday,
                'day' => Carbon::yesterday()->format('l')
            ],
            [
                'currency' => 'USD',
                'city' => 'Sanaa',
                'price_buy' => 533.0,
                'price_sell' => 535.0,
                'date' => $twoDaysAgo,
                'day' => Carbon::yesterday()->subDay()->format('l')
            ]
        ];

        // Create a new instance for this test
        $currencyService = Mockery::mock(CurrencyService::class)->makePartial();
        $currencyService->shouldReceive('getLastTwentyDays')
            ->once()
            ->andReturn($testData);

        // Test the method
        $result = $currencyService->getTodayCurrencies();

        // Should include yesterday's data for Sanaa and Aden
        $this->assertCount(3, $result);

        // Check that only Sanaa and Aden cities are included
        $cities = array_column($result, 'city');
        $this->assertContains('Sanaa', $cities);
        $this->assertContains('Aden', $cities);

        // Check that only yesterday's data is included (most recent)
        $dates = array_unique(array_column($result, 'date'));
        $this->assertCount(1, $dates);
        $this->assertEquals($yesterday, $dates[0]);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
