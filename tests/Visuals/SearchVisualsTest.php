<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Visuals;

use Livewire\Livewire;
use PHPUnit\Framework\Attributes\Group;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\PetsTable;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;

#[Group('Visuals')]
final class SearchVisualsTest extends TestCase
{
    public function test_search_shows_be_default(): void
    {
        Livewire::test(PetsTable::class)
            ->assertSeeHtml('wire:model.live="search"');
    }

    public function test_search_doesnt_show_if_search_disabled(): void
    {
        Livewire::test(PetsTable::class)
            ->call('setSearchDisabled')
            ->assertDontSee('wire:model="search"');
    }

    public function test_search_doesnt_show_if_search_visibility_disabled(): void
    {
        Livewire::test(PetsTable::class)
            ->call('setSearchVisibilityDisabled')
            ->assertDontSee('wire:model="search"');
    }

    /* Temporary Removal */
    /*
    public function test_search_clear_button_shows_when_there_is_input(): void
    {
        Livewire::test(PetsTable::class)
            ->assertDontSeeHtml('<span wire:click="clearSearch"')
            ->call('setSearch', 'Anthony')
            ->assertSeeHtml('<span wire:click="clearSearch"');
    }*/

    public function test_search_debounce_filter_is_applied(): void
    {
        Livewire::test(PetsTable::class)
            ->assertDontSeeHtml('wire:model.live.debounce.1000ms="search"')
            ->call('setSearchDebounce', 1000)
            ->assertSeeHtml('wire:model.live.debounce.1000ms="search"');
    }

    public function test_search_throttle_filter_is_applied(): void
    {
        Livewire::test(PetsTable::class)
            ->assertDontSeeHtml('wire:model.live.throttle.1000ms="search"')
            ->call('setSearchThrottle', 1000)
            ->assertSeeHtml('wire:model.live.throttle.1000ms="search"');
    }

    public function test_search_blur_filter_is_applied(): void
    {
        Livewire::test(PetsTable::class)
            ->assertDontSeeHtml('wire:model.blur="search"')
            ->call('setSearchBlur')
            ->assertSeeHtml('wire:model.blur="search"');
    }

    public function test_search_lazy_filter_is_applied(): void
    {
        Livewire::test(PetsTable::class)
            ->assertDontSeeHtml('wire:model.live.lazy="search"')
            ->call('setSearchLazy')
            ->assertSeeHtml('wire:model.live.lazy="search"');
    }

    public function test_search_defer_filter_is_applied(): void
    {
        Livewire::test(PetsTable::class)
            ->call('setSearchDefer')
            ->assertSeeHtml('wire:model="search"');
    }

    public function test_search_live_filter_is_applied(): void
    {
        Livewire::test(PetsTable::class)
            ->call('setSearchLazy')
            ->assertDontSeeHtml('wire:model.live="search"')
            ->call('setSearchLive')
            ->assertSeeHtml('wire:model.live="search"');
    }

    public function test_search_via_query_string_functions(): void
    {
        Livewire::withQueryParams(['table-search' => 'Cartman'])
            ->test(PetsTable::class)
            ->assertSee('Cartman')
            ->assertDontSee('Chico');

        Livewire::withQueryParams(['table-search' => 'Chico'])
            ->test(PetsTable::class)
            ->assertSee('Chico')
            ->assertDontSee('Cartman');

        $mock = new class extends PetsTable
        {
            public ?array $testAttributesArray;

            public function configure(): void
            {
                $this->setPrimaryKey('id');
                $this->setDataTableFingerprint('test');
                $this->setQueryStringAliasForSearch('pet-search');
            }
        };

        Livewire::withQueryParams(['table-search' => 'Chico'])
            ->test($mock)
            ->assertSee('Chico')
            ->assertSee('Cartman');

        Livewire::withQueryParams(['pet-search' => 'Chico'])
            ->test($mock)
            ->assertSee('Chico')
            ->assertDontSee('Cartman');

        Livewire::withQueryParams(['pet-search' => null])
            ->test($mock)
            ->assertSee('Chico')
            ->assertSee('Cartman');

        Livewire::withQueryParams([])
            ->test($mock)
            ->assertSee('Chico')
            ->assertSee('Cartman');

    }
}
