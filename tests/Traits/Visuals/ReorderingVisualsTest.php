<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Traits\Visuals;

use Livewire\Livewire;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\PetsTable;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;

class ReorderingVisualsTest extends TestCase
{
    /** @test */
    public function testFilterArraySetup(): array
    {
        $filterDefaultArray = ['breed' => [], 'species' => [], 'breed_id_filter' => null, 'pet_name_filter' => null, 'last_visit_date_filter' => null, 'last_visit_datetime_filter' => null, 'breed_select_filter' => null];
        $this->assertNotEmpty($filterDefaultArray);

        return $filterDefaultArray;
    }

    /** @test */
    /** Temporarily Removed - Will Use a Dusk Test */
    /*
    public function sortable_call_only_available_if_enabled(): void
    {
        Livewire::test(PetsTable::class)
            ->assertDontSee('wire:sortable=')
            ->call('setReorderEnabled')
            ->assertSee('wire:sortable=');
    }*/

    /** @test */
    /** Temporarily Removed - Will Use a Dusk Test */
    /*
    public function reorder_columns_added_when_enabled(): void
    {
        Livewire::test(PetsTable::class)
            ->call('setReorderEnabled')
            ->assertDontSee('wire:sortable.handle')
            ->assertDontSee('wire:sortable.item')
            ->call('setCurrentlyReorderingEnabled')
            ->assertSee('wire:sortable.handle')
            ->assertSee('wire:sortable.item');
    }*/

    /** @test */
    /** Temporarily Removed - Will Use a Dusk Test */
    /*
    public function order_column_hidden_until_reordering_if_enabled(): void
    {
        Livewire::test(PetsTable::class)
            ->call('setReorderEnabled')
            ->assertSee('Sort')
            ->call('setHideReorderColumnUnlessReorderingEnabled')
            ->assertDontSee('Sort')
            ->call('setCurrentlyReorderingEnabled')
            ->assertSee('Sort');
    }*/

    /** @test */
    /** Temporarily Removed - Will Use a Dusk Test */
    /*
    public function reorder_button_doesnt_show_when_disabled(): void
    {
        Livewire::test(PetsTable::class)
            ->assertDontSee('Reorder');
    }
    */

    /** @test */
    /** Temporarily Removed - Will Use a Dusk Test */
    /*
    public function reorder_button_shows_when_enabled(): void
    {
        Livewire::test(PetsTable::class)
            ->call('setReorderEnabled')
            ->assertSee('Reorder');
    }*/

    /** @test */
    /** Temporarily Removed - Will Use a Dusk Test */
    /*
    public function reorder_button_shows_correct_text_based_on_status(): void
    {
        Livewire::test(PetsTable::class)
            ->call('setReorderEnabled')
            ->assertSee('Reorder')
            ->call('setCurrentlyReorderingEnabled')
            ->assertSee('Done Reordering');
    }*/

    /** @test */
    public function sorting_pills_hide_on_reorder(): void
    {
        Livewire::test(PetsTable::class)
            ->call('setReorderEnabled')
            ->assertSet('sortingPillsStatus', true)
            ->call('sortBy', 'id')
            ->assertSeeHtml('wire:key="sorting-pill-id"')
            ->call('enableReordering')
            ->assertSet('sortingPillsStatus', false)
            ->assertDontSeeHtml('wire:key="sorting-pill-id"')
            ->call('disableReordering')
            ->call('sortBy', 'id')
            ->assertSet('sortingPillsStatus', true)
            ->assertSeeHtml('wire:key="sorting-pill-id"');
    }

    /**
     * @test
     *
     * @depends testFilterArraySetup
     */
    public function sorting_is_disabled_on_reorder(array $filterDefaultArray): void
    {
        Livewire::test(PetsTable::class)
            ->call('setReorderEnabled')
            ->assertSet('sortingStatus', true)
            ->call('sortBy', 'id')
            ->assertSet('sorts', ['id' => 'asc'])
            ->assertSet('filterComponents', $filterDefaultArray)
            ->assertSeeHtml('wire:click="sortBy(\'id\')"')
            ->call('enableReordering')
            ->assertSet('sortingStatus', false)
            ->assertSet('table', [])
            ->assertDontSeeHtml('wire:click="sortBy(\'id\')"')
            ->call('disableReordering')
            ->assertSet('sortingStatus', true)
            ->assertSet('filterComponents', $filterDefaultArray)
            ->assertSet('sorts', ['id' => 'asc'])

            ->assertSeeHtml('wire:click="sortBy(\'id\')"');
    }

    /** @test */
    public function pagination_hides_on_reorder(): void
    {
        Livewire::test(PetsTable::class)
            ->call('setReorderEnabled')
            ->call('setPerPageAccepted', [1])
            ->call('setPerPage', 1)
            ->assertSet('paginationStatus', true)
            ->assertSeeHtml('<span aria-current="page">')
            ->call('enableReordering')
            ->assertSet('paginationStatus', false)
            ->assertDontSeeHtml('<span aria-current="page">')
            ->call('disableReordering')
            ->assertSet('paginationStatus', true)
            ->assertSeeHtml('<span aria-current="page">');
    }

    /** @test */
    public function per_page_hides_on_reorder(): void
    {
        Livewire::test(PetsTable::class)
            ->call('setReorderEnabled')
            ->assertSet('perPageVisibilityStatus', true)
            ->assertSeeHtml('wire:model="perPage"')
            ->call('enableReordering')
            ->assertSet('perPageVisibilityStatus', false)
            ->assertDontSeeHtml('wire:model="perPage"')
            ->call('disableReordering')
            ->assertSet('perPageVisibilityStatus', true)
            ->assertSeeHtml('wire:model="perPage"');
    }

    /** @test */
    public function per_page_accepted_gets_set_on_reorder(): void
    {
        Livewire::test(PetsTable::class)
            ->call('setReorderEnabled')
            ->assertSet('perPageAccepted', [10, 25, 50])
            ->call('enableReordering')
            ->assertSet('perPageAccepted', [-1])
            ->call('disableReordering')
            ->assertSet('perPageAccepted', [10, 25, 50]);
    }

    /** @test */
    public function per_page_gets_set_on_reorder(): void
    {
        Livewire::test(PetsTable::class)
            ->call('setReorderEnabled')
            ->assertSet('perPage', 10)
            ->call('enableReordering')
            ->assertSet('perPage', -1)
            ->call('disableReordering')
            ->assertSet('perPage', 10);
    }

    /** @test
     * @depends testFilterArraySetup
     */
    public function search_hides_on_reorder(array $filterDefaultArray): void
    {
        Livewire::test(PetsTable::class)
            ->call('setReorderEnabled')
            ->assertSet('searchStatus', true)
            ->assertSee('Search')
            ->set('search', 'abc123')
            ->call('enableReordering')
            ->assertSet('searchStatus', false)
            ->assertSet('search', '')
            ->assertDontSee('Search')
            ->call('disableReordering')
            ->assertSet('searchStatus', true)
            ->assertSet('search', 'abc123')
            ->assertSee('Search');
    }

    /** @test */
    public function current_page_gets_reset_on_reorder(): void
    {
        Livewire::test(PetsTable::class)
            ->call('setReorderEnabled')
            ->call('setPerPageAccepted', [1])
            ->call('setPerPage', 1)
            ->set('page', 1)
            ->assertSet('page', 1)
            ->set('page', 3)
            ->call('enableReordering')
            ->set('page', 1)
            ->assertSet('page', 1);
        //            ->call('disableReordering') // TODO: Don't work
        //            ->assertSet('page', 3);
    }

    /** @test */
    public function bulk_actions_dropdown_gets_hidden_on_reorder(): void
    {
        Livewire::test(PetsTable::class)
            ->call('setReorderEnabled')
            ->assertSet('bulkActionsStatus', true)
            ->call('setBulkActions', ['activate' => 'Activate'])
            ->assertSee('Bulk Actions')
            ->call('enableReordering')
            ->assertSet('bulkActionsStatus', false)
            ->assertDontSee('Bulk Actions');
    }

    /** @test */
    public function bulk_actions_header_gets_hidden_on_reorder(): void
    {
        Livewire::test(PetsTable::class)
            ->call('setReorderEnabled')
            ->assertSet('bulkActionsStatus', true)
            ->call('setBulkActions', ['activate' => 'Activate'])
            ->assertSeeHtml('selectedItems.length == paginationTotalItemCount')
            ->call('enableReordering')
            ->assertSet('bulkActionsStatus', false)
            ->assertDontSee('Select All');
    }

    /** @test */
    public function bulk_actions_cell_gets_hidden_on_reorder(): void
    {
        Livewire::test(PetsTable::class)
            ->call('setReorderEnabled')
            ->assertSet('bulkActionsStatus', true)
            ->call('setBulkActions', ['activate' => 'Activate'])
            ->assertSeeHtml('x-model="selectedItems"')
            ->call('enableReordering')
            ->assertSet('bulkActionsStatus', false)
            ->assertDontSee('Select All');
    }

    /** @test */
    public function bulk_actions_row_select_all_gets_hidden_on_reorder(): void
    {
        Livewire::test(PetsTable::class)
            ->call('setReorderEnabled')
            ->assertSet('bulkActionsStatus', true)
            ->call('setBulkActions', ['activate' => 'Activate'])
            ->call('setAllSelected')
            ->assertSee('You are currently selecting all')
            ->call('enableReordering')
            ->assertSet('bulkActionsStatus', false)
            ->assertDontSee('You are currently selecting all');
    }

    /** @test */
    public function bulk_actions_row_select_some_gets_hidden_on_reorder(): void
    {
        Livewire::test(PetsTable::class)
            ->call('setReorderEnabled')
            ->assertSet('bulkActionsStatus', true)
            ->call('setBulkActions', ['activate' => 'Activate'])
            ->call('setSelected', [1, 2, 3])
            ->assertSee('do you want to select all')
            ->call('enableReordering')
            ->assertSet('bulkActionsStatus', false)
            ->assertDontSee('do you want to select all');
    }

    /**
     * @test
     *
     * @depends testFilterArraySetup
     */
    public function filters_are_disabled_on_reorder(array $filterDefaultArray): void
    {
        $customisedFilterArray = $filterDefaultArray;
        $customisedFilterArray['breed'] = [1];

        Livewire::test(PetsTable::class)
            ->call('setReorderEnabled')
            ->assertSet('filtersStatus', true)
            ->set('filterComponents.breed', [1])
            ->assertSet('filterComponents', $customisedFilterArray)
            ->assertSee('Filters')
            ->call('enableReordering')
            ->assertSet('filtersStatus', false)
            ->assertSet('table', [])
            ->assertDontSeeHtml('Filters')
            ->call('disableReordering')
            ->assertSet('filtersStatus', true)
            ->set('filterComponents.breed', [])
            ->assertSet('filterComponents', $filterDefaultArray)
            ->assertSeeHtml('Filters');
    }

    /**
     * @test
     *
     * @depends testFilterArraySetup
     */
    public function filter_pills_hide_on_reorder(array $filterDefaultArray): void
    {
        $filterDefaultArray['breed'] = [1];

        Livewire::test(PetsTable::class)
            ->call('setReorderEnabled')
            ->set('filterComponents.breed', [1])
            ->assertSet('filterComponents', $filterDefaultArray)
            ->assertSee('Applied Filters')
            ->call('enableReordering')
            ->assertDontSee('Applied Filters');
    }

    /** @test */
    public function column_select_does_not_hide_on_reorder(): void
    {
        Livewire::test(PetsTable::class)
            ->call('setReorderEnabled')
            ->assertSee('Columns')
            ->call('enableReordering')
            ->assertSee('Columns');
    }

    /** @test */
    public function collapsing_columns_hide_on_reorder(): void
    {
        // TODO
        $this->assertTrue(true);
    }

    /** @test */
    public function secondary_header_hides_on_reorder(): void
    {
        // TODO
        $this->assertTrue(true);
    }

    /** @test */
    public function footer_hides_on_reorder(): void
    {
        // TODO
        $this->assertTrue(true);
    }

    // TODO: Append as new features added
}
