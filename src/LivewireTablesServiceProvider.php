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

        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'laravel-livewire-tables');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/laravel-livewire-tables'),
        ]);

        $this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/laravel-livewire-tables'),
        ]);
    }
}
