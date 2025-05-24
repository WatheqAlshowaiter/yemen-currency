<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Rate;

class RateController extends Controller
{
    public function __invoke()
    {

        $supportedCities = City::query()
            ->whereIn('name', City::supportedCities())
            ->get()
            ->sortByDesc(fn ($city) => $city->name === 'sanaa')
            ->values();

        $rates = Rate::query()
            ->with('currency', 'city')
            ->orderBy('city_id', 'asc')
            ->orderBy('currency_id', 'asc')
            ->orderBy('date', 'desc')
            ->get()
            ->groupBy(fn ($rate) => $rate->city_id.'-'.$rate->currency_id)
            ->map(fn ($group) => $group->first())
            ->groupBy('city_id');

        return view('rates', [
            'rates' => $rates,
            'supportedCities' => $supportedCities,
        ]);
    }
}
