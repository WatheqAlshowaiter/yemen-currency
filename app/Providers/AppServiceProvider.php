<?php

namespace App\Providers;

use Carbon\CarbonImmutable;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        DB::prohibitDestructiveCommands(app()->isProduction());

        URL::forceHttps(app()->isProduction());

        Model::shouldBeStrict(! app()->isProduction());

        Date::use(CarbonImmutable::class);

        Paginator::defaultSimpleView('vendor/pagination/simple-default');
    }
}
