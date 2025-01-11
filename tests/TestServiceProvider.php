<?php

namespace Rappasoft\LaravelLivewireTables\Tests;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Rappasoft\LaravelLivewireTables\Tests\Http\Components\TestComponent;

class TestServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Blade::component('test-component', TestComponent::class);
        $this->loadViewsFrom(__DIR__.'/views', 'livewire-tables-test');

    }
}
