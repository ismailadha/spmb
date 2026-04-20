<?php

namespace App\Providers;

use App\Models\Konfigurasi;
use App\Models\PeriodeDaftar;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

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
        Paginator::useBootstrapFour();

        // Share app configurations globally across all views
        if (! $this->app->runningInConsole()) {
            try {
                $appConfig = Konfigurasi::pluck('nilai', 'kunci')->toArray();
                view()->share('appConfig', $appConfig);

                $activePeriode = PeriodeDaftar::where('status_aktif', 1)->first();
                view()->share('activePeriode', $activePeriode);
            } catch (\Exception $e) {
                // Skip if table doesn't exist yet (during migrations)
            }
        }
    }
}
