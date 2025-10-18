<?php

use App\Http\Controllers\PrivacyPolicyController;
use App\Http\Controllers\RateController;
use Illuminate\Support\Facades\Route;

Route::get('/', RateController::class);
Route::get('/privacy-policy', PrivacyPolicyController::class);
