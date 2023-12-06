<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Traits\Visuals;

use Livewire\Livewire;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\PetsTableCustomEmpty;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;

class CustomisationVisualsTest extends TestCase
{
    /** @test */
    public function can_customise_empty_message(): void
    {
        Livewire::test(PetsTableCustomEmpty::class)
            ->set('search', 'sdfsdfsdfadsfasdfasdd')
            ->assertDontSee('No items found')
            ->set('search', '')
            ->assertDontSee('No items found')
            ->set('search', '')
            ->assertDontSee('Test Custom Empty Message')
            ->set('search', 'sdfsdfsdfadsfasdfasdd')
            ->assertSee('Test Custom Empty Message');
    }
}
