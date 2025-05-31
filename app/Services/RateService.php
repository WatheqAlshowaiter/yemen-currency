<?php

namespace App\Services;

use App\Models\City;
use App\Models\Rate;

class RateService
{
    public function getFormattedRates()
    {
        $supportedCities = City::query()
            ->whereIn('name', City::supportedCities()) // Filter only supported cities
            ->get()
            ->sortByDesc(fn($city) => $city->name === 'sanaa') // Sort to put 'sanaa' first
            ->values();  // Reset array keys to be sequential
        
        $latestRates = Rate::query()
            ->whereIn('city_id', $supportedCities->pluck('id'))
            ->with('currency', 'city')
            ->orderBy('date', 'desc') // first sort by latest date
            ->orderBy('city_id', 'asc') // then sort by city_id
            ->orderBy('currency_id', 'asc') // then sort by currency_id
            ->simplePaginate(4);

            $transformedRates = $latestRates->getCollection()
                ->map(function($rate) {
                    return [
                        'city_name' => $rate->city->label,
                        'currency_name' => $rate->currency->name,
                        'buy_price' => $rate->buy_price,
                        'sell_price' => $rate->sell_price,
                        'date' => $rate->date->toDateString(),
                        'day' => $rate->date->locale('ar')->isoFormat('dddd'),
                        'is_today' => $rate->date->isToday(),
                        'last_update' => $rate->updated_at->diffForHumans(),
                    ];
                })
            ->groupBy('city_name')
            ->map(function($cityRates, $cityName) {
                return [
                    'city' => $cityName,
                    'rates' => $cityRates->map(function($rate) {
                        return [
                            'currency' => $rate['currency_name'],
                            'buy_price' => $rate['buy_price'],
                            'sell_price' => $rate['sell_price'],
                            'date' => $rate['date'],
                            'day' => $rate['day'],
                            'is_today' => $rate['is_today'],
                            'last_update' => $rate['last_update'],
                        ];
                    })->values()->toArray()
                ];
            })
            ->values(); // Reset keys to be sequential

            $latestRates->setCollection($transformedRates);

        return $latestRates;
    }
}
