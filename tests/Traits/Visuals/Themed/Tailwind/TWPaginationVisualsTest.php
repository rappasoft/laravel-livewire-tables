<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Traits\Visuals\Themed\Tailwind;

use Rappasoft\LaravelLivewireTables\Tests\Traits\Visuals\Themed\BasePaginationVisuals;

final class TWPaginationVisualsTest extends BasePaginationVisuals
{
    protected function setupBasicTableForBrowsing()
    {
        return $this->setupBasicTableForLivewire()
            ->call('setTheme', 'tailwind');
    }

    protected function setupBasicTableSingleRecord()
    {
        return $this->setupSingleRecordBasicTable()
            ->call('setTheme', 'tailwind');
    }

    public function test_pagination_shows_by_default(): void
    {
        $this->setupBasicTableSingleRecord()
            ->assertSeeHtml('<nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between">');
    }

    public function test_per_page_shows_by_default(): void
    {
        $this->setupBasicTableForBrowsing()
            ->assertSeeHtml('wire:model.live="perPage"');
    }

    public function test_pagination_is_removed_when_hidden(): void
    {
        $this->setupBasicTableSingleRecord()
            ->call('setPaginationVisibilityDisabled')
            ->assertDontSeeHtml('<nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between">');
    }

    public function test_pagination_is_removed_when_disabled(): void
    {
        $this->setupBasicTableSingleRecord()
            ->call('setPaginationDisabled')
            ->assertDontSeeHtml('<nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between">');
    }

    public function test_per_page_is_removed_when_hidden(): void
    {
        $this->setupBasicTableForBrowsing()
            ->call('setPerPageVisibilityDisabled')
            ->assertDontSeeHtml('wire:model.live="perPage"');

    }

    public function test_per_page_is_removed_when_pagination_disabled(): void
    {
        $this->setupBasicTableForBrowsing()
            ->call('setPaginationDisabled')
            ->assertDontSeeHtml('wire:model.live="perPage"');
    }

    public function test_paged_results_label_shows_with_pagination_enabled_and_more_than_one_page(): void
    {
        $this->setupBasicTableSingleRecord()
            ->assertSeeHtml('<p class="paged-pagination-results text-sm text-gray-700 leading-5 dark:text-white">');
    }

    public function test_paged_results_label_doesnt_show_with_pagination_enabled_and_less_than_one_page(): void
    {
        $this->setupBasicTableForBrowsing()
            ->assertDontSeeHtml('<p class="paged-pagination-results text-sm text-gray-700 leading-5 dark:text-white">');
    }

    public function test_total_results_label_shows_with_one_page_and_pagination_enabled(): void
    {
        $this->setupBasicTableForBrowsing()
            ->assertSeeHtml('<p class="total-pagination-results text-sm text-gray-700 leading-5 dark:text-white">');
    }

    public function test_total_results_label_shows_with_pagination_disabled(): void
    {
        $this->setupBasicTableForBrowsing()
            ->call('setPaginationDisabled')
            ->assertSeeHtml('<p class="total-pagination-results text-sm text-gray-700 leading-5 dark:text-white">');
    }

    public function test_paged_results_label_doesnt_show_with_pagination_hidden(): void
    {
        $this->setupBasicTableForBrowsing()
            ->call('setPaginationVisibilityDisabled')
            ->assertDontSeeHtml('<p class="paged-pagination-results text-sm text-gray-700 leading-5 dark:text-white">');

        $this->setupBasicTableSingleRecord()
            ->call('setPaginationVisibilityDisabled')
            ->assertDontSeeHtml('<p class="paged-pagination-results text-sm text-gray-700 leading-5 dark:text-white">');
    }

    public function test_total_results_label_doesnt_show_with_pagination_hidden(): void
    {
        $this->setupBasicTableForBrowsing()
            ->call('setPaginationVisibilityDisabled')
            ->assertDontSeeHtml('<p class="total-pagination-results text-sm text-gray-700 leading-5 dark:text-white">');

        $this->setupBasicTableSingleRecord()
            ->call('setPaginationVisibilityDisabled')
            ->assertDontSeeHtml('<p class="total-pagination-results text-sm text-gray-700 leading-5 dark:text-white">');

    }

    /* Broken Test - HtmlInOrder does not work cleanly */
    /*public function test_per_page_dropdown_renders_with_correct_values(): void
    {
        Livewire::test(PetsTable::class)
            ->assertSeeHtmlInOrder(['<option value="10" wire:key="per-page-10-table">10</option>', '<option value="25" wire:key="per-page-25-table">25</option>', '<option value="50" wire:key="per-page-50-table">50</option>']);
    }*/

    /* Broken Test - HtmlInOrder does not work cleanly */
    /*public function test_per_page_dropdown_renders_with_all_option(): void
    {
        Livewire::test(PetsTable::class)
            ->call('setPerPageAccepted', [10, 25, 50, -1])
            ->assertSeeHtmlInOrder(
                ['<option value="10" wire:key="per-page-10-table">10</option>',
            '<option value="25" wire:key="per-page-25-table">25</option>',
            '<option value="50" wire:key="per-page-50-table">50</option>',
            '<option value="-1" wire:key="per-page--1-table">All</option>'
        ]);
    }*/

    public function test_can_get_currently_displayed_ids(): void
    {
        $this->setupBasicTableForBrowsing()
            ->assertSet('paginationCurrentItems', [1, 2, 3, 4, 5])
            ->assertNotSet('paginationCurrentItems', [1, 2, 3, 4, 5, 6, 7, 8, 9]);
    }

    public function test_can_get_currently_displayed_count(): void
    {
        $this->setupBasicTableForBrowsing()
            ->assertSet('paginationCurrentCount', 5)
            ->assertNotSet('paginationCurrentCount', 125);
    }

    public function test_detailed_pagination_is_displayed_standard(): void
    {
        $this->tableWithStandardDetailedPagination()
            ->assertSeeHtmlInOrder([
                '<p class="paged-pagination-results text-sm text-gray-700 leading-5 dark:text-white">',
                '<span>Showing</span>',
                '<span class="font-medium">1</span>',
                '<span>to</span>',
                '<span>of</span>',
            ]);
    }

    public function test_detailed_pagination_is_displayed_simple(): void
    {
        $this->tableWithSimpleDetailedPagination()
            ->assertSeeHtmlInOrder([
                '<p class="paged-pagination-results text-sm text-gray-700 leading-5 dark:text-white">',
                '<span>Showing</span>',
                '<span class="font-medium">1</span>',
                '<span>to</span>',
                '<span class="font-medium">3</span>',
            ])
            ->assertDontSeeHtml('<span>of</span>');
    }

    public function test_detailed_pagination_is_not_displayed_standard_tw(): void
    {
        $this->setupBasicTableForBrowsing()
            ->call('disableDetailedPagination', 'standard')
            ->assertDontSeeHtml('<span>Showing</span>')
            ->assertDontSeeHtml('<span>to</span>')
            ->assertDontSeeHtml('<span>of</span>');
    }

    public function test_detailed_pagination_is_not_displayed_simple_tw(): void
    {
        $this->setupBasicTableForBrowsing()
            ->call('disableDetailedPagination', 'simple')
            ->assertDontSeeHtml('<span>Showing</span>')
            ->assertDontSeeHtml('<span>to</span>');
    }

    public function test_pagination_field_can_set_colors(): void
    {
        $this->setupBasicTableForBrowsing()
            ->assertSeeHtmlInOrder([
                '<select wire:model.live="perPage" id="table-perPage"',
                'class="block w-full rounded-md shadow-sm transition duration-150 ease-in-out sm:text-sm sm:leading-5 focus:ring focus:ring-opacity-50 border-gray-300 focus:border-indigo-300 focus:ring-indigo-200 dark:bg-gray-700 dark:text-white dark:border-gray-600"',
            ])
            ->call('setPerPageFieldAttributes', [
                'default-colors' => true,
            ])
            ->assertSeeHtmlInOrder([
                '<select wire:model.live="perPage" id="table-perPage"',
                'class="block w-full rounded-md shadow-sm transition duration-150 ease-in-out sm:text-sm sm:leading-5 focus:ring focus:ring-opacity-50 border-gray-300 focus:border-indigo-300 focus:ring-indigo-200 dark:bg-gray-700 dark:text-white dark:border-gray-600"',
            ])
            ->call('setPerPageFieldAttributes', [
                'class' => 'testclass1',
            ])
            ->assertSeeHtmlInOrder([
                '<select wire:model.live="perPage" id="table-perPage"',
                'class="block w-full rounded-md shadow-sm transition duration-150 ease-in-out sm:text-sm sm:leading-5 focus:ring focus:ring-opacity-50 border-gray-300 focus:border-indigo-300 focus:ring-indigo-200 dark:bg-gray-700 dark:text-white dark:border-gray-600 testclass1"',
            ])
            ->call('setPerPageFieldAttributes', [
                'class' => 'bg-gre-500 dark:bg-ba-500',
                'default-colors' => false,
            ])
            ->assertSeeHtmlInOrder([
                '<select wire:model.live="perPage" id="table-perPage"',
                'class="block w-full rounded-md shadow-sm transition duration-150 ease-in-out sm:text-sm sm:leading-5 focus:ring focus:ring-opacity-50 bg-gre-500 dark:bg-ba-500"',
            ]);
    }

    public function test_pagination_field_can_set_styling(): void
    {
        $this->setupBasicTableForBrowsing()
            ->assertSeeHtmlInOrder([
                '<select wire:model.live="perPage" id="table-perPage"',
                'class="block w-full rounded-md shadow-sm transition duration-150 ease-in-out sm:text-sm sm:leading-5 focus:ring focus:ring-opacity-50 border-gray-300 focus:border-indigo-300 focus:ring-indigo-200 dark:bg-gray-700 dark:text-white dark:border-gray-600"',
            ])
            ->call('setPerPageFieldAttributes', [
                'default-styling' => true,
            ])
            ->assertSeeHtmlInOrder([
                '<select wire:model.live="perPage" id="table-perPage"',
                'class="block w-full rounded-md shadow-sm transition duration-150 ease-in-out sm:text-sm sm:leading-5 focus:ring focus:ring-opacity-50 border-gray-300 focus:border-indigo-300 focus:ring-indigo-200 dark:bg-gray-700 dark:text-white dark:border-gray-600"',
            ])
            ->call('setPerPageFieldAttributes', [
                'default-styling' => false,
            ])
            ->assertSeeHtmlInOrder([
                '<select wire:model.live="perPage" id="table-perPage"',
                'class="border-gray-300 focus:border-indigo-300 focus:ring-indigo-200 dark:bg-gray-700 dark:text-white dark:border-gray-600"',
            ])
            ->call('setPerPageFieldAttributes', [
                'class' => 'testclass1',
            ])
            ->assertSeeHtmlInOrder([
                '<select wire:model.live="perPage" id="table-perPage"',
                'class="block w-full rounded-md shadow-sm transition duration-150 ease-in-out sm:text-sm sm:leading-5 focus:ring focus:ring-opacity-50 border-gray-300 focus:border-indigo-300 focus:ring-indigo-200 dark:bg-gray-700 dark:text-white dark:border-gray-600 testclass1"',
            ])
            ->call('setPerPageFieldAttributes', [
                'class' => 'bg-gre-500 dark:bg-ba-500',
                'default-styling' => false,
            ])
            ->assertSeeHtmlInOrder([
                '<select wire:model.live="perPage" id="table-perPage"',
                'class="border-gray-300 focus:border-indigo-300 focus:ring-indigo-200 dark:bg-gray-700 dark:text-white dark:border-gray-600 bg-gre-500 dark:bg-ba-500"',
            ]);
    }

    public function test_pagination_field_can_remove_default_styling_and_colors(): void
    {
        $this->setupBasicTableForBrowsing()
            ->assertSeeHtmlInOrder([
                '<select wire:model.live="perPage" id="table-perPage"',
                'class="block w-full rounded-md shadow-sm transition duration-150 ease-in-out sm:text-sm sm:leading-5 focus:ring focus:ring-opacity-50 border-gray-300 focus:border-indigo-300 focus:ring-indigo-200 dark:bg-gray-700 dark:text-white dark:border-gray-600"',
            ])
            ->call('setPerPageFieldAttributes', [
                'class' => 'bg-gre-500 dark:bg-ba-500',
                'default-styling' => false,
                'default-colors' => false,
            ])
            ->assertSeeHtmlInOrder([
                '<select wire:model.live="perPage" id="table-perPage"',
                'class="bg-gre-500 dark:bg-ba-500"',
            ]);
    }
}
