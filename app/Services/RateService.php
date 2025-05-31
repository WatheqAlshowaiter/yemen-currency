<?php

namespace App\Services;

use App\Models\City;
use App\Models\Rate;

class RateService
{
    public function getFormattedRates(): array
    {
        $supportedCities = City::query()
            ->whereIn('name', City::supportedCities()) // Filter only supported cities
            ->get()
            ->sortByDesc(fn($city) => $city->name === 'sanaa') // Sort to put 'sanaa' first
            ->values();  // Reset array keys to be sequential

        // Get the latest exchange rates for each currency in each city
        $latestRates = Rate::query()
            ->with('currency', 'city')
            ->orderBy('city_id', 'asc')
            ->orderBy('currency_id', 'asc')
            ->orderBy('date', 'desc')
            ->get()
            ->groupBy(fn($rate) => $rate->city_id . '-' . $rate->currency_id)
            ->map(fn($group) => $group->first())
            ->groupBy('city_id');


        // Format the rates
        $rates = $supportedCities->map(function ($city) use ($latestRates) {
            $cityRates = $latestRates->get($city->id, collect())->map(function ($rate) {
                return [
                    'currency'    => $rate->currency->name,
                    'buy_price'   => $rate->buy_price,
                    'sell_price'  => $rate->sell_price,
                    'date'        => $rate->date->toDateString(),
                    'day'         => $rate->date->locale('ar')->isoFormat('dddd'),
                    'last_update' => $rate->updated_at->diffForHumans(),
                ];
            })->values()->toArray();

            return [
                'city'  => $city->label ,
                'rates' => $cityRates,
            ];
        })->toArray();

        return $rates;
    }
}
