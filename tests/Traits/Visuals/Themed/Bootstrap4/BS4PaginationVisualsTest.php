<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Traits\Visuals\Themed\Bootstrap4;

use Rappasoft\LaravelLivewireTables\Tests\Traits\Visuals\Themed\BasePaginationVisuals;

final class BS4PaginationVisualsTest extends BasePaginationVisuals
{
    protected function setupBasicTableForBrowsing()
    {
        return $this->setupBasicTableForLivewire()
            ->call('setTheme', 'bootstrap-4');
    }

    protected function setupBasicTableSingleRecord()
    {
        return $this->setupSingleRecordBasicTable()
            ->call('setTheme', 'bootstrap-4');
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
            ->assertSeeHtml('<select wire:model.live="perPage" id="table-perPage" class="form-control">');
    }

    public function test_detailed_pagination_is_displayed_standard_bs4(): void
    {
        $this->tableWithStandardDetailedPagination()
            ->assertSeeHtmlInOrder([
                '<div class="col-12 col-md-6 text-center text-md-right text-muted">',
                '<span>Showing</span>',
                '<strong>1</strong>',
                '<span>to</span>',
                '<span>of</span>',
            ]);
    }

    public function test_detailed_pagination_is_displayed_simple_bs4(): void
    {
        $this->tableWithSimpleDetailedPagination()
            ->assertSeeHtmlInOrder([
                '<div class="col-12 col-md-6 overflow-auto">',
                '<span>Showing</span>',
                '<strong>1</strong>',
                '<span>to</span>',
            ])
            ->assertDontSeeHtml('<span>of</span>');
    }

    public function test_detailed_pagination_is_not_displayed_standard_bs4(): void
    {
        $this->setupBasicTableForBrowsing()
            ->call('disableDetailedPagination', 'standard')
            ->assertDontSeeHtml('<span>Showing</span>')
            ->assertDontSeeHtml('<span>to</span>')
            ->assertDontSeeHtml('<span>of</span>');
    }

    public function test_detailed_pagination_is_not_displayed_simple_bs4(): void
    {
        $this->setupBasicTableForBrowsing()
            ->call('disableDetailedPagination', 'simple')
            ->assertDontSeeHtml('<span>Showing</span>')
            ->assertDontSeeHtml('<span>to</span>');
    }
}
