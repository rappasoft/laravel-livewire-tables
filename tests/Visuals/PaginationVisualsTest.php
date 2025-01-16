<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Visuals;

use Livewire\Livewire;
use PHPUnit\Framework\Attributes\Group;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\{PetsTable};
use Rappasoft\LaravelLivewireTables\Tests\TestCase;

#[Group('Visuals')]
final class PaginationVisualsTest extends TestCase
{
    public function test_pagination_shows_by_default(): void
    {
        Livewire::test(PetsTable::class)
            ->call('setPerPageAccepted', [1])
            ->call('setPerPage', 1)
            ->assertSeeHtml('<nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between">');
    }

    public function test_per_page_shows_by_default(): void
    {
        Livewire::test(PetsTable::class)
            ->assertSeeHtml('wire:model.live="perPage"');
    }

    public function test_pagination_is_removed_when_hidden(): void
    {
        Livewire::test(PetsTable::class)
            ->call('setPerPageAccepted', [1])
            ->call('setPerPage', 1)
            ->call('setPaginationVisibilityDisabled')
            ->assertDontSeeHtml('<nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between">');
    }

    public function test_pagination_is_removed_when_disabled(): void
    {
        Livewire::test(PetsTable::class)
            ->call('setPerPageAccepted', [1])
            ->call('setPerPage', 1)
            ->call('setPaginationDisabled')
            ->assertDontSeeHtml('<nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between">');
    }

    public function test_per_page_is_removed_when_hidden(): void
    {
        Livewire::test(PetsTable::class)
            ->call('setPerPageVisibilityDisabled')
            ->assertDontSeeHtml('wire:model.live="perPage"');

    }

    public function test_per_page_is_removed_when_pagination_disabled(): void
    {
        Livewire::test(PetsTable::class)
            ->call('setPaginationDisabled')
            ->assertDontSeeHtml('wire:model.live="perPage"');
    }

    public function test_paged_results_label_shows_with_pagination_enabled_and_more_than_one_page(): void
    {
        Livewire::test(PetsTable::class)
            ->call('setPerPageAccepted', [1])
            ->call('setPerPage', 1)
            ->assertSeeHtml('<p class="paged-pagination-results text-sm text-gray-700 leading-5 dark:text-white">');
    }

    public function test_paged_results_label_doesnt_show_with_pagination_enabled_and_less_than_one_page(): void
    {
        Livewire::test(PetsTable::class)
            ->assertDontSeeHtml('<p class="paged-pagination-results text-sm text-gray-700 leading-5 dark:text-white">');
    }

    public function test_total_results_label_shows_with_one_page_and_pagination_enabled(): void
    {
        Livewire::test(PetsTable::class)
            ->assertSeeHtml('<p class="total-pagination-results text-sm text-gray-700 leading-5 dark:text-white">');
    }

    public function test_total_results_label_shows_with_pagination_disabled(): void
    {
        Livewire::test(PetsTable::class)
            ->call('setPaginationDisabled')
            ->assertSeeHtml('<p class="total-pagination-results text-sm text-gray-700 leading-5 dark:text-white">');
    }

    public function test_paged_results_label_doesnt_show_with_pagination_hidden(): void
    {
        Livewire::test(PetsTable::class)
            ->call('setPaginationVisibilityDisabled')
            ->assertDontSeeHtml('<p class="paged-pagination-results text-sm text-gray-700 leading-5 dark:text-white">');
    }

    public function test_total_results_label_doesnt_show_with_pagination_hidden(): void
    {
        Livewire::test(PetsTable::class)
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

    public function test_per_page_dropdown_only_renders_with_accepted_values(): void
    {
        $this->expectException(DataTableConfigurationException::class);

        Livewire::test(PetsTable::class)
            ->call('setPerPage', 15);
    }

    public function test_can_get_currently_displayed_ids(): void
    {
        Livewire::test(PetsTable::class)->assertSet('paginationCurrentItems', [1, 2, 3, 4, 5])
            ->assertNotSet('paginationCurrentItems', [1, 2, 3, 4, 5, 6, 7, 8, 9]);
    }

    public function test_can_get_currently_displayed_count(): void
    {
        Livewire::test(PetsTable::class)->assertSet('paginationCurrentCount', 5)
            ->assertNotSet('paginationCurrentCount', 125);
    }

    public function test_detailed_pagination_is_displayed_standard_tw(): void
    {
        Livewire::test(PetsTable::class)
            ->call('enableDetailedPagination', 'standard')
            ->assertSeeHtmlInOrder(['<p class="paged-pagination-results text-sm text-gray-700 leading-5 dark:text-white">',
                '<span>Showing</span>',
                '<span class="font-medium">1</span>',
                '<span>to</span>',
                '<span>of</span>',
            ]);
    }

    public function test_detailed_pagination_is_displayed_simple_tw(): void
    {
        Livewire::test(PetsTable::class)
            ->call('enableDetailedPagination', 'simple')
            ->assertSeeHtmlInOrder(['<p class="paged-pagination-results text-sm text-gray-700 leading-5 dark:text-white">',
                '<span>Showing</span>',
                '<span class="font-medium">1</span>',
                '<span>to</span>',
                '<span class="font-medium">3</span>',
            ])
            ->assertDontSeeHtml('<span>of</span>');
    }

    public function test_detailed_pagination_is_not_displayed_standard_tw(): void
    {
        Livewire::test(PetsTable::class)
            ->call('disableDetailedPagination', 'standard')
            ->assertDontSeeHtml('<span>Showing</span>')
            ->assertDontSeeHtml('<span>to</span>')
            ->assertDontSeeHtml('<span>of</span>');
    }

    public function test_detailed_pagination_is_not_displayed_simple_tw(): void
    {
        Livewire::test(PetsTable::class)
            ->call('disableDetailedPagination', 'simple')
            ->assertDontSeeHtml('<span>Showing</span>')
            ->assertDontSeeHtml('<span>to</span>');
    }

    //

    public function test_detailed_pagination_is_displayed_standard_bs4(): void
    {
        Livewire::test(PetsTable::class)
            ->call('setTheme', 'bootstrap-4')
            ->call('enableDetailedPagination', 'standard')
            ->assertSeeHtmlInOrder(['<div class="col-12 col-md-6 text-center text-muted text-md-right">',
                '<span>Showing</span>',
                '<strong>1</strong>',
                '<span>to</span>',
                '<span>of</span>',
            ]);
    }

    public function test_detailed_pagination_is_displayed_simple_bs4(): void
    {
        Livewire::test(PetsTable::class)
            ->call('setTheme', 'bootstrap-4')
            ->call('enableDetailedPagination', 'simple')
            ->assertSeeHtmlInOrder(['<div class="col-12 col-md-6 overflow-auto">',
                '<span>Showing</span>',
                '<strong>1</strong>',
                '<span>to</span>',
            ])
            ->assertDontSeeHtml('<span>of</span>');
    }

    public function test_detailed_pagination_is_not_displayed_standard_bs4(): void
    {
        Livewire::test(PetsTable::class)
            ->call('setTheme', 'bootstrap-4')
            ->call('disableDetailedPagination', 'standard')
            ->assertDontSeeHtml('<span>Showing</span>')
            ->assertDontSeeHtml('<span>to</span>')
            ->assertDontSeeHtml('<span>of</span>');
    }

    public function test_detailed_pagination_is_not_displayed_simple_bs4(): void
    {
        Livewire::test(PetsTable::class)
            ->call('setTheme', 'bootstrap-4')
            ->call('disableDetailedPagination', 'simple')
            ->assertDontSeeHtml('<span>Showing</span>')
            ->assertDontSeeHtml('<span>to</span>');
    }

    public function test_detailed_pagination_is_displayed_standard_bs5(): void
    {
        Livewire::test(PetsTable::class)
            ->call('setTheme', 'bootstrap-5')
            ->call('enableDetailedPagination', 'standard')
            ->assertSeeHtmlInOrder(['<div class="col-12 col-md-6 text-center text-muted text-md-end">',
                '<span>Showing</span>',
                '<strong>1</strong>',
                '<span>to</span>',
                '<span>of</span>',
            ]);
    }

    public function test_detailed_pagination_is_displayed_simple_bs5(): void
    {
        Livewire::test(PetsTable::class)
            ->call('setTheme', 'bootstrap-5')
            ->call('enableDetailedPagination', 'simple')
            ->assertSeeHtmlInOrder(['<div class="col-12 col-md-6 text-center text-muted text-md-end">',
                '<span>Showing</span>',
                '<strong>1</strong>',
                '<span>to</span>',
            ])
            ->assertDontSeeHtml('<span>of</span>');
    }

    public function test_detailed_pagination_is_not_displayed_standard_bs5(): void
    {
        Livewire::test(PetsTable::class)
            ->call('setTheme', 'bootstrap-5')
            ->call('disableDetailedPagination', 'standard')
            ->assertDontSeeHtml('<span>Showing</span>')
            ->assertDontSeeHtml('<span>to</span>')
            ->assertDontSeeHtml('<span>of</span>');
    }

    public function test_detailed_pagination_is_not_displayed_simple_bs5(): void
    {
        Livewire::test(PetsTable::class)
            ->call('setTheme', 'bootstrap-5')
            ->call('disableDetailedPagination', 'simple')
            ->assertDontSeeHtml('<span>Showing</span>')
            ->assertDontSeeHtml('<span>to</span>');
    }

    public function test_pagination_field_can_set_colors(): void
    {
        Livewire::test(PetsTable::class)
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
        Livewire::test(PetsTable::class)
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
        Livewire::test(PetsTable::class)
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
