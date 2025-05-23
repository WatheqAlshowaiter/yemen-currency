<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Schedule::command('currency:fetch --today')
    ->everySixHours() // 
    ->appendOutputTo(storage_path('logs/currency-fetch.log'));
    