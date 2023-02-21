<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Traits\Visuals;

use Livewire\Livewire;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\PetsTable;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\PetsTableNoFilters;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;

class ToolbarVisualsTest extends TestCase
{
    /** @test */
    public function toolbar_shows_when_enabled(): void
    {
        Livewire::test(PetsTable::class)
            ->assertSee('flex-col tools');
    }

    /** @test */
    public function toolbar_doesnt_show_when_disabled(): void
    {
        Livewire::test(PetsTable::class)
            ->call('setToolbarDisabled')
            ->assertDontSee('flex-col tools');
    }
}
