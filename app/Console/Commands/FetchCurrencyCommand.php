<?php

namespace App\Console\Commands;

use App\Models\City;
use App\Models\Currency;
use App\Models\Rate;
use App\Services\CurrencyService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class FetchCurrencyCommand extends Command
{
    protected $signature = 'currency:fetch {--today : Fetch only today\'s data}';

    protected $description = 'Fetch currency exchange rates from boqash.com';

    /**
     * Execute the console command.
     */
    public function handle(CurrencyService $currencyService): int
    {
        $this->info('Fetching currency data...');

        try {
            if ($this->option('today')) {
                $data = $this->fetchTodayData($currencyService);
            } else {
                $data = $this->fetchHistoricalData($currencyService);
            }

            foreach ($data as $item) {

                $city = match ($item['city']) {
                    'Sanaa' => City::where('name', 'sanaa')->first(),
                    'Aden' => City::where('name', 'aden')->first(),
                };

                $currency = match ($item['currency']) {
                    'USD' => Currency::where('code', 'USD')->first(),
                    'SAR' => Currency::where('code', 'SAR')->first(),
                };

                Rate::updateOrCreate([
                    'city_id' => $city?->id,
                    'currency_id' => $currency?->id,
                    'date' => $item['date'],
                ], [
                    'buy_price' => $item['price_buy'],
                    'sell_price' => $item['price_sell'],
                ]);
            }

            $this->info('Currency data fetched successfully!');

            return Command::SUCCESS;
        } catch (\Exception $e) {
            $this->error('Failed to fetch currency data: '.$e->getMessage());
            Log::error('Currency fetch command failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            // todo mail when failing using resend

            return Command::FAILURE;
        }
    }

    /**
     * Fetch and display today's currency data.
     *
     * @return array
     */
    protected function fetchTodayData(CurrencyService $currencyService)
    {
        $data = $currencyService->getTodayCurrencies();

        if (empty($data)) {
            $this->warn('No currency data available for today.');

            return;
        }

        $this->info('Today\'s Currency Data:');
        $this->table(
            ['Currency', 'City', 'Buy Price', 'Sell Price', 'Date', 'Day'],
            array_map(function ($item) {
                return [
                    $item['currency'],
                    $item['city'],
                    $item['price_buy'],
                    $item['price_sell'],
                    $item['date'],
                    $item['day'],
                ];
            }, $data)
        );

        return $data;
    }

    /**
     * Fetch and display historical currency data.
     *
     * @return array
     */
    protected function fetchHistoricalData(CurrencyService $currencyService)
    {
        $data = $currencyService->getLastTwentyDays();

        if (empty($data)) {
            $this->warn('No historical currency data available.');

            return [];
        }

        $this->info('Last 20 Days Currency Data:');
        $this->table(
            ['Currency', 'City', 'Buy Price', 'Sell Price', 'Date', 'Day'],
            array_map(function ($item) {
                return [
                    $item['currency'],
                    $item['city'],
                    $item['price_buy'],
                    $item['price_sell'],
                    $item['date'],
                    $item['day'],
                ];
            }, $data)
        );

        return $data;
    }
}
