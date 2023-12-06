<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Traits\Visuals;

use Livewire\Livewire;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\PetsTable;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;

class CustomisationVisualsTest extends TestCase
{
    /** @test */
    public function can_customise_empty_message_view(): void
    {
        Livewire::test(PetsTable::class)
        ->set('search', 'sdfsdfsdfadsfasdfasdd')
        ->assertSee('No items found')
        ->assertDontSee('Test Custom Empty Message')
        ->call('setCustomEmptyView', 'livewire-tables::tests.testCustomEmpty')
        ->assertDontSee('No items found')
        ->assertSee('Test Custom Empty Message')
        ->set('search', '')
        ->call('setCustomEmptyView', 'livewire-tables::tests.testCustomEmpty')
        ->assertDontSee('No items found')
        ->assertDontSee('Test Custom Empty Message')
        ->set('search', 'sdfsdfsdfadsfasdfasdd')
        ->call('setCustomEmptyView', 'livewire-tables::tests.testCustomEmpty')
        ->assertSee('Test Custom Empty Message')
        ->assertDontSee('No items found')
        ->set('search', 'sdfsdfsdfadsfasdfasdd')
        ->call('setCustomEmptyView', '')
        ->assertDontSee('Test Custom Empty Message')
        ->assertSee('No items found');
    }
}
