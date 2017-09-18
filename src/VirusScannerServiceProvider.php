<?php

namespace Daniesy\VirusScanner;

use Illuminate\Support\ServiceProvider;


class VirusScannerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([ __DIR__."/config/config.php" => config_path('virus_scanner.php') ]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind("VirusScanner", function() {
            return new VirusScanner;
        });
    }
}