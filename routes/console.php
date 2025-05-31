<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('currency:fetch --today')
    ->everySixHours()
    ->appendOutputTo(storage_path('logs/currency-fetch.log'))
    ->onFailure(function () {
        // TODO: set the correct sender email
        // TODO: set the correct recipient email
         
        // \Illuminate\Support\Facades\Mail::raw(
        //     "Currency fetching failed!\n\nCheck the page: https://boqash.com/price-currency\nAnd review the logs for more details.",
        //     function (\Illuminate\Mail\Message $message) {
        //         $message
        //             ->from(config('mail.from.address')) 
        //             ->to(config('mail.admin.address'))   
        //             ->subject('Currency Fetching Failed!');
        //     }
        // );
    });