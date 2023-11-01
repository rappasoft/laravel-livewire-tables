<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Traits\Visuals;

use Livewire\Livewire;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\PetsTable;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;

class SearchVisualsTest extends TestCase
{
    /** @test */
    public function search_shows_be_default(): void
    {
        Livewire::test(PetsTable::class)
            ->assertSeeHtml('wire:model.live="search"');
    }

    /** @test */
    public function search_doesnt_show_if_search_disabled(): void
    {
        Livewire::test(PetsTable::class)
            ->call('setSearchDisabled')
            ->assertDontSee('wire:model="search"');
    }

    /** @test */
    public function search_doesnt_show_if_search_visibility_disabled(): void
    {
        Livewire::test(PetsTable::class)
            ->call('setSearchVisibilityDisabled')
            ->assertDontSee('wire:model="search"');
    }

    /** @test */
    /* Temporary Removal */
    /*
    public function search_clear_button_shows_when_there_is_input(): void
    {
        Livewire::test(PetsTable::class)
            ->assertDontSeeHtml('<span wire:click="clearSearch"')
            ->call('setSearch', 'Anthony')
            ->assertSeeHtml('<span wire:click="clearSearch"');
    }*/

    /** @test */
    public function search_debounce_filter_is_applied(): void
    {
        Livewire::test(PetsTable::class)
            ->assertDontSeeHtml('wire:model.live.debounce.1000ms="search"')
            ->call('setSearchDebounce', 1000)
            ->assertSeeHtml('wire:model.live.debounce.1000ms="search"');
    }

    /** @test */
    public function search_throttle_filter_is_applied(): void
    {
        Livewire::test(PetsTable::class)
            ->assertDontSeeHtml('wire:model.live.throttle.1000ms="search"')
            ->call('setSearchThrottle', 1000)
            ->assertSeeHtml('wire:model.live.throttle.1000ms="search"');
    }

    /** @test */
    public function search_blur_filter_is_applied(): void
    {
        Livewire::test(PetsTable::class)
            ->assertDontSeeHtml('wire:model.blur="search"')
            ->call('setSearchBlur')
            ->assertSeeHtml('wire:model.blur="search"');
    }

    /** @test */
    public function search_defer_filter_is_applied(): void
    {
        Livewire::test(PetsTable::class)
            ->call('setSearchDefer')
            ->assertSeeHtml('wire:model="search"');
    }

    /** @test */
    public function search_live_filter_is_applied(): void
    {
        Livewire::test(PetsTable::class)
            ->assertDontSeeHtml('wire:model="search"')
            ->call('setSearchLive')
            ->assertSeeHtml('wire:model.live="search"');
    }
}
