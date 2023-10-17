<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Traits\Visuals;

use Livewire\Livewire;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\PetsTable;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;

class LoadingPlaceholderVisualsTest extends TestCase
{
    /** @test */
    public function can_see_placeholder_text(): void
    {
        Livewire::test(PetsTable::class)
            ->call('setPerPageAccepted', [1])
            ->call('setPerPage', 1)
            ->assertSeeHtml('<nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between">');
    }
}
