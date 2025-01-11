<?php

namespace Rappasoft\LaravelLivewireTables\Tests;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Rappasoft\LaravelLivewireTables\Tests\Http\Components\TestComponent;

class TestServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Blade::component('test-component', TestComponent::class);
        $this->loadViewsFrom(__DIR__.'/views', 'livewire-tables-test');

    }
}