<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Visuals;

use Livewire\Livewire;
use PHPUnit\Framework\Attributes\Group;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\PetsTableLoadingPlaceholder;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;

#[Group('Visuals')]
final class LoadingPlaceholderVisualsTest extends TestCase
{
    public function test_can_see_placeholder_section(): void
    {
        Livewire::test(PetsTableLoadingPlaceholder::class)
            ->call('setPerPageAccepted', [1, 5, 10])
            ->assertSeeHtml('tr wire:key="table-loader')
            ->call('setPerPage', 5);
    }

    public function test_can_see_placeholder_custom_text(): void
    {
        Livewire::test(PetsTableLoadingPlaceholder::class)
            ->call('setPerPageAccepted', [1, 5, 10])
            ->assertSeeHtmlInOrder([
                '<tr wire:key="table-loader"',
                '<td colspan="',
                '<div class="h-min self-center align-middle text-center"',
                '<div class="lds-hourglass"',
                '<div>TestLoadingPlaceholderContentTestTest</div>',
            ])
            ->call('setPerPage', 5);
    }

    public function test_can_see_correct_placeholder_text_visually(): void
    {
        Livewire::test(PetsTableLoadingPlaceholder::class)
            ->call('setPerPageAccepted', [1, 5, 10])
            ->assertSee('TestLoadingPlaceholderContentTestTest')
            ->call('setPerPage', 5);
    }

    public function test_cannot_see_incorrect_placeholder_text_visually(): void
    {
        Livewire::test(PetsTableLoadingPlaceholder::class)
            ->call('setPerPageAccepted', [1, 5, 10])
            ->assertDontSee('TestLoadingPlaceholderContentTestTest22')
            ->call('setPerPage', 5);
    }
}
