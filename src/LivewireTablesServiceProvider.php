<?php

namespace Rappasoft\LaravelLivewireTables;

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
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'laravel-livewire-tables');
        
        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/laravel-livewire-tables'),
        ]);
    }
}
