<?php

namespace Rappasoft\LivewireTables;

use Illuminate\Support\ServiceProvider;

/**
 * Class LivewireTablesServiceProvider.
 */
class LivewireTablesServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/livewire-tables.php' => config_path('livewire-tables.php'),
            ], 'config');
        }

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'laravel-livewire-tables');
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Register the config file
        $this->mergeConfigFrom(__DIR__.'/../config/livewire-tables.php', 'livewire-tables');
    }
}
