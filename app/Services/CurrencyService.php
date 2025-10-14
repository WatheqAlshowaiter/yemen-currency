<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Symfony\Component\BrowserKit\HttpBrowser;
use Symfony\Component\DomCrawler\Crawler;

class CurrencyService
{
    /**
     * The URL to scrape currency data from
     */
    protected string $url = 'https://boqash.com/price-currency/';

    /**
     * Cities to filter by
     */
    protected array $cities = ['Sanaa', 'Aden'];

    /**
     * Cache TTL in minutes
     * 
     * 5 minutes less than 6 hours to avoid cache conflicts  with schedule command every six hours
     */
    protected int $cacheTtl = 350;

    public function getLastTwentyDays(): array
    {
        try {
            $client = new HttpBrowser();
            $crawler = $client->request('GET', $this->url);
            $table = $crawler->filter('table')->first();
            $rows = $table->filter('tbody')->filter('tr');

            $results = [];

            foreach ($rows as $row) {
                $rowCrawler = new Crawler($row);
                $cells = $rowCrawler->filter('td');

                if ($cells->count() >= 5) {
                    $currency = $this->getCurrency($cells->eq(0)->text());
                    $city = $this->getCity($cells->eq(1)->text());
                    $priceBuy = $this->getPrice($cells->eq(2)->text());
                    $priceSell = $this->getPrice($cells->eq(3)->text());
                    $date = $this->getDate($cells->eq(4)->text());

                    $results[] = [
                        'currency' => $currency,
                        'city' => $city,
                        'price_buy' => $priceBuy,
                        'price_sell' => $priceSell,
                        'date' => $date->format('Y-m-d'),
                        'day' => $date->format('l'),
                    ];
                }
            }

            return $results;

        } catch (\Exception $e) {
            Log::error('Failed to fetch currency data for last twenty days', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return [];
        }
    }

    /**
     * Get today's currency data for Sanaa and Aden
     *
     * @return array
     */
    public function getTodayCurrencies(): array
    {
        try {
            $allData = $this->getLastTwentyDays();

            $today = Carbon::today();

            // Filter for today's data and specific cities
            $todayData = array_filter($allData, function ($item) use ($today) {
                return $item['date'] === $today->format('Y-m-d') && in_array($item['city'], $this->cities);
            });

            // If no data for today, get the most recent data
            if (empty($todayData)) {
                // Sort by date descending
                usort($allData, function ($a, $b) {
                    return strtotime($b['date']) - strtotime($a['date']);
                });

                // Get the most recent date
                $mostRecentDate = !empty($allData) ? $allData[0]['date'] : null;

                if ($mostRecentDate) {
                    $todayData = array_filter($allData, function ($item) use ($mostRecentDate) {
                        return $item['date'] === $mostRecentDate && in_array($item['city'], $this->cities);
                    });
                }
            }

            return array_values($todayData);
        } catch (\Exception $e) {
            Log::error('Failed to fetch today\'s currency data', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return [];
        }
    }

    /**
     * Convert currency text to code
     *
     * @param string $currencyText
     * @return string
     */
    private function getCurrency(string $currencyText): string
    {
        $currency = trim($currencyText);

        return match ($currency) {
            'دولار أمريكي' => 'USD',
            'ريال سعودي' => 'SAR',
            default => $currency
        };
    }

    /**
     * Clean and return city name
     *
     * @param string $cityText
     * @return string
     */
    private function getCity(string $cityText): string
    {
        $city = trim($cityText);

        return match ($city) {
            'صنعاء' => "Sanaa",
            'عدن' => 'Aden',
        };
    }

    /**
     * Extract and clean price value
     *
     * @param string $priceText
     * @return float
     */
    private function getPrice(string $priceText): float
    {
        // Remove special characters
        $priceText = str_replace(['●', '▲', '▼', 'ريال', ','], '', $priceText);

        // Extract only numbers and decimal point
        $priceText = preg_replace('/[^0-9.]/', '', $priceText);

        return (float) $priceText;
    }

    /**
     * Parse date text to Carbon instance
     *
     * @param string $dateText
     * @return Carbon
     */
    private function getDate(string $dateText): Carbon
    {
        return Carbon::parse($dateText);
    }
}
