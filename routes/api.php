<?php

use App\Http\Controllers\RateController;
use Illuminate\Support\Facades\Route;

Route::get('/rates', [RateController::class, 'api']);
