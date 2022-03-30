<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Traits\Visuals;

use Livewire\Livewire;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\PetsTable;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;

class PaginationVisualsTest extends TestCase
{
    /** @test */
    public function pagination_shows_by_default(): void
    {
        Livewire::test(PetsTable::class)
            ->call('setPerPageAccepted', [1])
            ->call('setPerPage', 1)
            ->assertSeeHtml('<nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between">');
    }

    /** @test */
    public function per_page_shows_by_default(): void
    {
        Livewire::test(PetsTable::class)
            ->assertSeeHtml(
                '<select
                        wire:model="perPage"
                        id="perPage"
                        class="block w-full border-gray-300 rounded-md shadow-sm transition duration-150 ease-in-out sm:text-sm sm:leading-5 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:text-white dark:border-gray-600"
                    >'
            );
    }

    /** @test */
    public function pagination_is_removed_when_hidden(): void
    {
        Livewire::test(PetsTable::class)
            ->call('setPerPageAccepted', [1])
            ->call('setPerPage', 1)
            ->call('setPaginationVisibilityDisabled')
            ->assertDontSeeHtml('<nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between">');
    }

    /** @test */
    public function pagination_is_removed_when_disabled(): void
    {
        Livewire::test(PetsTable::class)
            ->call('setPerPageAccepted', [1])
            ->call('setPerPage', 1)
            ->call('setPaginationDisabled')
            ->assertDontSeeHtml('<nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between">');
    }

    /** @test */
    public function per_page_is_removed_when_hidden(): void
    {
        Livewire::test(PetsTable::class)
            ->call('setPerPageVisibilityDisabled')
            ->assertDontSeeHtml(
                '<select
                        wire:model="perPage"
                        id="perPage"
                        class="block w-full border-gray-300 rounded-md shadow-sm transition duration-150 ease-in-out sm:text-sm sm:leading-5 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:text-white dark:border-gray-600"
                    >'
            );
    }

    /** @test */
    public function per_page_is_removed_when_pagination_disabled(): void
    {
        Livewire::test(PetsTable::class)
            ->call('setPaginationDisabled')
            ->assertDontSeeHtml(
                '<select
                        wire:model="perPage"
                        id="perPage"
                        class="block w-full border-gray-300 rounded-md shadow-sm transition duration-150 ease-in-out sm:text-sm sm:leading-5 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:text-white dark:border-gray-600"
                    >'
            );
    }

    /** @test */
    public function paged_results_label_shows_with_pagination_enabled_and_more_than_one_page(): void
    {
        Livewire::test(PetsTable::class)
            ->call('setPerPageAccepted', [1])
            ->call('setPerPage', 1)
            ->assertSeeHtml('<p class="paged-pagination-results text-sm text-gray-700 leading-5 dark:text-white">');
    }

    /** @test */
    public function paged_results_label_doesnt_show_with_pagination_enabled_and_less_than_one_page(): void
    {
        Livewire::test(PetsTable::class)
            ->assertDontSeeHtml('<p class="paged-pagination-results text-sm text-gray-700 leading-5 dark:text-white">');
    }

    /** @test */
    public function total_results_label_shows_with_one_page_and_pagination_enabled(): void
    {
        Livewire::test(PetsTable::class)
            ->assertSeeHtml('<p class="total-pagination-results text-sm text-gray-700 leading-5 dark:text-white">');
    }

    /** @test */
    public function total_results_label_shows_with_pagination_disabled(): void
    {
        Livewire::test(PetsTable::class)
            ->call('setPaginationDisabled')
            ->assertSeeHtml('<p class="total-pagination-results text-sm text-gray-700 leading-5 dark:text-white">');
    }

    /** @test */
    public function paged_results_label_doesnt_show_with_pagination_hidden(): void
    {
        Livewire::test(PetsTable::class)
            ->call('setPaginationVisibilityDisabled')
            ->assertDontSeeHtml('<p class="paged-pagination-results text-sm text-gray-700 leading-5 dark:text-white">');
    }

    /** @test */
    public function total_results_label_doesnt_show_with_pagination_hidden(): void
    {
        Livewire::test(PetsTable::class)
            ->call('setPaginationVisibilityDisabled')
            ->assertDontSeeHtml('<p class="total-pagination-results text-sm text-gray-700 leading-5 dark:text-white">');
    }

    /** @test */
    public function per_page_dropdown_renders_with_correct_values(): void
    {
        Livewire::test(PetsTable::class)
            ->assertSeeHtmlInOrder(['<option value="10" wire:key="per-page-10-table">10</option>', '<option value="25" wire:key="per-page-25-table">25</option>', '<option value="50" wire:key="per-page-50-table">50</option>']);
    }

    /** @test */
    public function per_page_dropdown_renders_with_all_option(): void
    {
        Livewire::test(PetsTable::class)
            ->call('setPerPageAccepted', [10, 25, 50, -1])
            ->assertSeeHtmlInOrder(['<option value="10" wire:key="per-page-10-table">10</option>', '<option value="25" wire:key="per-page-25-table">25</option>', '<option value="50" wire:key="per-page-50-table">50</option>', '<option value="-1" wire:key="per-page--1-table">All</option>']);
    }

    /** @test */
    public function per_page_dropdown_only_renders_with_accepted_values(): void
    {
        $this->expectException(DataTableConfigurationException::class);

        Livewire::test(PetsTable::class)
            ->call('setPerPage', 15);
    }
}
