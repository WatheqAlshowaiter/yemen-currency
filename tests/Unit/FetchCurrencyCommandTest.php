<?php

namespace Tests\Unit;

use App\Models\City;
use App\Models\Currency;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use App\Console\Commands\FetchCurrencyCommand;
use App\Services\CurrencyService;
use Mockery;

class FetchCurrencyCommandTest extends TestCase
{

    use RefreshDatabase;

    protected $command;
    protected $currencyService;

    protected function setUp(): void
    {
        parent::setUp();

        // Create a mock for the CurrencyService
        $this->currencyService = Mockery::mock(CurrencyService::class);
        $this->app->instance(CurrencyService::class, $this->currencyService);

        // Create the command
        $this->command = new FetchCurrencyCommand();
    }

    public function testHandleWithTodayOption()
    {
        $this->seedData();

        // Sample data for today's currencies
        $todayCurrencies = [
            [
                'currency' => 'USD',
                'city' => 'Sanaa',
                'price_buy' => 535.0,
                'price_sell' => 537.0,
                'date' => '2025-05-19',
                'day' => 'Monday'
            ],
            [
                'currency' => 'SAR',
                'city' => 'Sanaa',
                'price_buy' => 139.8,
                'price_sell' => 140.2,
                'date' => '2025-05-19',
                'day' => 'Monday'
            ]
        ];

        // Configure the mock to return our sample data
        $this->currencyService->shouldReceive('getTodayCurrencies')
            ->once()
            ->andReturn($todayCurrencies);

        // We don't expect getLastTwentyDays to be called
        $this->currencyService->shouldReceive('getLastTwentyDays')
            ->never();

        // Create a mock for the command to capture output
        $this->artisan('currency:fetch', ['--today' => true])
            ->expectsOutput('Fetching currency data...')
            ->expectsOutput('Today\'s Currency Data:')
            ->expectsOutput('Currency data fetched successfully!')
            ->assertExitCode(0);
    }

    public function testHandleWithoutTodayOption()
    {
        $this->seedData();

        // Sample data for historical currencies
        $historicalCurrencies = [
            [
                'currency' => 'USD',
                'city' => 'Sanaa',
                'price_buy' => 535.0,
                'price_sell' => 537.0,
                'date' => '2025-05-19',
                'day' => 'Monday'
            ],
            [
                'currency' => 'USD',
                'city' => 'Sanaa',
                'price_buy' => 534.0,
                'price_sell' => 536.0,
                'date' => '2025-05-18',
                'day' => 'Sunday'
            ]
        ];

        // Configure the mock to return our sample data
        $this->currencyService->shouldReceive('getLastTwentyDays')
            ->once()
            ->andReturn($historicalCurrencies);

        // We don't expect getTodayCurrencies to be called
        $this->currencyService->shouldReceive('getTodayCurrencies')
            ->never();

        // Create a mock for the command to capture output
        $this->artisan('currency:fetch')
            ->expectsOutput('Fetching currency data...')
            ->expectsOutput('Last 20 Days Currency Data:')
            ->expectsOutput('Currency data fetched successfully!')
            ->assertExitCode(0);
    }

    public function testHandleWithEmptyData()
    {
        // Configure the mock to return empty data
        $this->currencyService->shouldReceive('getLastTwentyDays')
            ->once()
            ->andReturn([]);

        // Create a mock for the command to capture output
        $this->artisan('currency:fetch')
            ->expectsOutput('Fetching currency data...')
            ->expectsOutput('No historical currency data available.')
            ->expectsOutput('Currency data fetched successfully!')
            ->assertExitCode(0);
    }

    public function testHandleWithException()
    {
        // Configure the mock to throw an exception
        $this->currencyService->shouldReceive('getLastTwentyDays')
            ->once()
            ->andThrow(new \Exception('Test exception'));

        // Create a mock for the command to capture output
        $this->artisan('currency:fetch')
            ->expectsOutput('Fetching currency data...')
            ->expectsOutput('Failed to fetch currency data: Test exception')
            ->assertExitCode(1);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    private function seedData(): void
    {
        $sanaa = City::factory()->sanaa()->create();
        $aden = City::factory()->aden()->create();

        $usdDollar = Currency::factory()->usdDollar()->create();
        $saudiRial = Currency::factory()->saudiRial()->create();
    }
}
