<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Traits\Visuals;

use Livewire\Livewire;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\PetsTable;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\PetsTableNoFilters;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;

class FilterVisualsTest extends TestCase
{
    /** @test */
    public function filters_button_shows_when_enabled(): void
    {
        Livewire::test(PetsTable::class)
            ->assertSee('Filters');
    }

    /** @test */
    public function filters_button_shows_when_visible(): void
    {
        Livewire::test(PetsTable::class)
            ->call('setFiltersVisibilityEnabled')
            ->assertSee('Filters');
    }

    /** @test */
    public function filters_button_doesnt_show_when_disabled(): void
    {
        Livewire::test(PetsTable::class)
            ->call('setFiltersDisabled')
            ->assertDontSee('Filters');
    }

    /** @test */
    public function filters_button_doesnt_show_when_hidden(): void
    {
        Livewire::test(PetsTable::class)
            ->call('setFiltersVisibilityDisabled')
            ->assertDontSee('Filters');
    }

    /** @test */
    public function filters_button_dont_show_when_there_are_no_filters_defined(): void
    {
        Livewire::test(PetsTableNoFilters::class)
            ->assertDontSee('Filters');
    }

    /** @test */
    public function filter_pills_show_when_enabled(): void
    {
        Livewire::test(PetsTable::class)
            ->set('table.filters.breed', [1])
            ->assertSee('Applied Filters');
    }

    /** @test */
    public function filter_pills_show_when_visible(): void
    {
        Livewire::test(PetsTable::class)
            ->set('table.filters.breed', [1])
            ->call('setFiltersVisibilityEnabled')
            ->assertSee('Applied Filters');
    }

    /** @test */
    public function filter_pills_dont_show_when_disabled(): void
    {
        Livewire::test(PetsTable::class)
            ->set('table.filters.breed', [1])
            ->call('setFilterPillsDisabled')
            ->assertDontSee('Applied Filters');
    }

    /** @test */
    public function filter_pills_dont_show_when_hidden(): void
    {
        Livewire::test(PetsTable::class)
            ->set('table.filters.breed', [1])
            ->call('setFilterPillsDisabled')
            ->assertDontSee('Applied Filters');
    }

    /** @test */
    public function filter_pills_dont_show_when_no_filters_are_applied(): void
    {
        Livewire::test(PetsTable::class)
            ->assertDontSee('Applied Filters');
    }
}
