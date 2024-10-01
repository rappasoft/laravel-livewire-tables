<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Traits\Visuals\Themed\Bootstrap5;

use Livewire\Livewire;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\{PetsTable};
use Rappasoft\LaravelLivewireTables\Tests\Traits\Visuals\Themed\ThemedTestCase;

final class BS5PaginationVisualsTest extends ThemedTestCase
{
    protected function setupBasicTableForBrowsing()
    {
        return $this->setupBasicTableForLivewire()
            ->call('setTheme', 'bootstrap-5');
    }

    protected function setupBasicTableSingleRecord()
    {
        return $this->setupSingleRecordBasicTable()
            ->call('setTheme', 'bootstrap-5');
    }

    public function test_pagination_shows_by_default(): void
    {
        $this->setupBasicTableSingleRecord()
            ->assertSeeHtml('<nav role="navigation" aria-label="Pagination Navigation">')
            ->assertSeeHtml('<ul class="pagination">');
    }

    public function test_per_page_shows_by_default(): void
    {
        $this->setupBasicTableForBrowsing()
            ->assertSeeHtml('<select wire:model.live="perPage" id="table-perPage" class="form-select">');
    }

    public function test_detailed_pagination_is_displayed_standard_bs5(): void
    {
        $this->tableWithStandardDetailedPagination()
            ->assertSeeHtmlInOrder([
                '<div class="col-12 col-md-6 text-center text-md-end text-muted">',
                '<span>Showing</span>',
                '<strong>1</strong>',
                '<span>to</span>',
                '<span>of</span>',
            ]);
    }

    public function test_detailed_pagination_is_displayed_simple(): void
    {
        $this->tableWithSimpleDetailedPagination()
            ->assertSeeHtmlInOrder([
                '<div class="col-12 col-md-6 text-center text-md-end text-muted">',
                '<span>Showing</span>',
                '<strong>1</strong>',
                '<span>to</span>',
            ])
            ->assertDontSeeHtml('<span>of</span>');
    }

    public function test_detailed_pagination_is_not_displayed_standard_bs5(): void
    {
        $this->setupBasicTableForBrowsing()
            ->call('disableDetailedPagination', 'standard')
            ->assertDontSeeHtml('<span>Showing</span>')
            ->assertDontSeeHtml('<span>to</span>')
            ->assertDontSeeHtml('<span>of</span>');
    }

    public function test_detailed_pagination_is_not_displayed_simple_bs5(): void
    {
        $this->setupBasicTableForBrowsing()
            ->call('disableDetailedPagination', 'simple')
            ->assertDontSeeHtml('<span>Showing</span>')
            ->assertDontSeeHtml('<span>to</span>');
    }
}
