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
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'laravel-livewire-tables');
    }
}
