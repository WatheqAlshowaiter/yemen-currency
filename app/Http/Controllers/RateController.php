<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Rate;
use App\Services\RateService;

class RateController extends Controller
{
    public function __invoke(RateService $rateService)
    {
        $rates = $rateService->getFormattedRates();

        return view('rates', [
            'rates' => $rates,
        ]);
    }

    public function api(RateService $rateService)
    {
        $rates = $rateService->getFormattedRates();

        return response()->json([
            'data' => $rates->items(),
            'next_page_url' => $rates->nextPageUrl(),
            'path' => $rates->path(),
            'per_page' => $rates->perPage(),
        ]);
    }
}
