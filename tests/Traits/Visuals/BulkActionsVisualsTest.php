<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Traits\Visuals;

use Livewire\Livewire;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\PetsTable;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;

class BulkActionsVisualsTest extends TestCase
{
    /** @test */
    public function bulk_dropdown_shows_when_necessary(): void
    {
        Livewire::test(PetsTable::class)
            ->call('setBulkActionsDisabled')
            ->assertDontSee('Bulk Actions')
            ->call('setBulkActionsEnabled')
            ->assertDontSee('Bulk Actions')
            ->call('setBulkActions', ['activate' => 'Activate'])
            ->assertSee('Bulk Actions')
            ->call('setBulkActions', [])
            ->call('setHideBulkActionsWhenEmptyEnabled')
            ->assertDontSee('Bulk Actions')
            ->call('setSelected', [1, 2, 3])
            ->assertSee('Bulk Actions');
    }

    /** @test */
    public function select_all_header_shows_if_bulk_actions_enabled_and_available(): void
    {
        Livewire::test(PetsTable::class)
            ->call('setBulkActionsDisabled')
            ->assertDontSeeHtml('wire:model="selectAll"')
            ->call('setBulkActionsEnabled')
            ->assertDontSeeHtml('wire:model="selectAll"')
            ->call('setBulkActions', ['activate' => 'Activate'])
            ->assertSeeHtml('wire:model="selectAll"');
    }

    /** @test */
    public function select_cell_shows_if_bulk_actions_enabled_and_available(): void
    {
        Livewire::test(PetsTable::class)
            ->call('setBulkActionsDisabled')
            ->assertDontSeeHtml('wire:model="selected"')
            ->call('setBulkActionsEnabled')
            ->assertDontSeeHtml('wire:model="selected"')
            ->call('setBulkActions', ['activate' => 'Activate'])
            ->assertSeeHtml('wire:model="selected"');
    }

    /** @test */
    public function bulk_actions_row_shows_if_bulk_actions_enabled_and_available_and_selected(): void
    {
        Livewire::test(PetsTable::class)
            ->call('setBulkActionsDisabled')
            ->assertDontSeeHtml('wire:key="bulk-select-message-table"')
            ->call('setBulkActionsEnabled')
            ->assertDontSeeHtml('wire:key="bulk-select-message-table"')
            ->call('setBulkActions', ['activate' => 'Activate'])
            ->assertDontSeeHtml('wire:key="bulk-select-message-table"')
            ->call('setSelected', [1, 2, 3])
            ->assertSeeHtml('wire:key="bulk-select-message-table"');
    }

    /** @test */
    public function bulk_actions_row_shows_correct_for_select_all(): void
    {
        Livewire::test(PetsTable::class)
            ->call('setBulkActionsDisabled')
            ->assertDontSee('You are currently selecting all')
            ->call('setBulkActionsEnabled')
            ->call('setBulkActions', ['activate' => 'Activate'])
            ->call('setAllSelected')
            ->assertSee('You are currently selecting all')
            ->assertDontSee('do you want to select all');
    }

    /** @test */
    public function bulk_actions_row_shows_correct_for_select_some(): void
    {
        Livewire::test(PetsTable::class)
            ->call('setBulkActionsDisabled')
            ->assertDontSee('do you want to select all')
            ->call('setBulkActionsEnabled')
            ->call('setBulkActions', ['activate' => 'Activate'])
            ->call('setSelected', [1, 2, 3])
            ->assertSee('do you want to select all')
            ->assertDontSee('You are currently selecting all');
    }
}
