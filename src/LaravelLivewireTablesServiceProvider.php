<?php

namespace Rappasoft\LaravelLivewireTables;

use Illuminate\Support\ServiceProvider;

/**
 * Class LaravelLivewireTablesServiceProvider.
 */
class LaravelLivewireTablesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'laravel-livewire-tables');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'laravel-livewire-tables');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('laravel-livewire-tables.php'),
            ], 'config');

            $this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/laravel-livewire-tables'),
            ], 'views');

            $this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/laravel-livewire-tables'),
            ], 'lang');
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'laravel-livewire-tables');
    }
}
