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

        \Livewire\Livewire::component('test-livewire-column-component', \Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\TestLivewireColumnComponent::class);

        $this->loadViewsFrom(__DIR__.'/views', 'livewire-tables-test');

    }
}
