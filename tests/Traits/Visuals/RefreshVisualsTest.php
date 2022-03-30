<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Traits\Visuals;

use Livewire\Livewire;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\PetsTable;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;

class RefreshVisualsTest extends TestCase
{
    /** @test */
    public function refresh_shows_no_poll_by_default(): void
    {
        Livewire::test(PetsTable::class)
            ->assertDontSee('wire:poll');
    }

    /** @test */
    public function refresh_shows_poll_in_milliseconds(): void
    {
        Livewire::test(PetsTable::class)
            ->call('setRefreshTime', 1000)
            ->assertSeeHtml('wire:poll.1000ms');
    }

    /** @test */
    public function refresh_shows_poll_keep_alive(): void
    {
        Livewire::test(PetsTable::class)
            ->call('setRefreshKeepAlive')
            ->assertSeeHtml('wire:poll.keep-alive');
    }

    /** @test */
    public function refresh_shows_poll_visible(): void
    {
        Livewire::test(PetsTable::class)
            ->call('setRefreshVisible')
            ->assertSeeHtml('wire:poll.visible');
    }

    /** @test */
    public function refresh_shows_poll_method(): void
    {
        Livewire::test(PetsTable::class)
            ->call('setRefreshMethod', 'myMethod')
            ->assertSeeHtml('wire:poll=myMethod');
    }
}
