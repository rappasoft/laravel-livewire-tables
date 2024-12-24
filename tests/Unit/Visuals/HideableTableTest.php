<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Visuals;

use Livewire\Livewire;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\PetsTable;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;
use PHPUnit\Framework\Attributes\Group;

#[Group('Visuals')]
final class HideableTableTest extends TestCase
{
    public function test_can_see_table_by_default(): void
    {
        $petsTable = (new class extends PetsTable
        {
            public function configure(): void
            {
                $this->setPrimaryKey('id');
            }

            public function bulkActions(): array
            {
                return ['exportBulk' => 'exportBulk'];
            }

            public function exportBulk($items)
            {
                return $items;
            }
        });
        Livewire::test($petsTable)
            ->assertSet('shouldBeDisplayed', true)
            ->assertSee('Cartman');
    }

    public function test_can_see_table_if_shown(): void
    {
        $this->setupEventsTable();

        Livewire::test($this->eventsTable)
            ->assertSet('shouldBeDisplayed', false)
            ->assertSee('Cartman')
            ->call('setShouldBeDisplayed')
            ->assertSet('shouldBeDisplayed', true)
            ->assertSee('Cartman');

    }

    public function test_can_not_see_hidden_table(): void
    {
        $this->setupEventsTable();

        Livewire::test($this->eventsTable)
            ->assertSee('Cartman')
            ->assertSet('shouldBeDisplayed', false)
            ->assertSee('Cartman');
    }

    public function test_can_show_hidden_table(): void
    {
        $this->setupEventsTable();

        Livewire::test($this->eventsTable)
            ->assertSet('shouldBeDisplayed', false)
            ->dispatch('showTable')
            ->assertSet('shouldBeDisplayed', true)
            ->assertSee('Cartman');

    }
}
