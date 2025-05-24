<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('currency:fetch --today')
    ->everySixHours()
    ->appendOutputTo(storage_path('logs/currency-fetch.log'));
