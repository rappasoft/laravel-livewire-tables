<?php

namespace Rappasoft\LaravelLivewireTables\Tests;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Rappasoft\LaravelLivewireTables\Tests\Http\Components\TestComponent;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\TestLivewireColumnComponent;

class TestServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Blade::component('test-component', TestComponent::class);

        Livewire::component('test-livewire-column-component', TestLivewireColumnComponent::class);

        $this->loadViewsFrom(__DIR__.'/views', 'livewire-tables-test');

    }
}
