<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Visuals;

use Livewire\Livewire;
use PHPUnit\Framework\Attributes\Group;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\PetsCollectionTable;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;

#[Group('Visuals')]
final class CollectionDataSourceVisualsTest extends TestCase
{
    public function test_it_renders_rows_from_a_collection(): void
    {
        Livewire::test(PetsCollectionTable::class)
            ->assertSee('Cartman')
            ->assertSee('Tux')
            ->assertSee('May')
            ->assertSee('Ben')
            ->assertSee('Chico');
    }

    public function test_search_filters_a_collection_data_source(): void
    {
        Livewire::test(PetsCollectionTable::class)
            ->set('search', 'Tux')
            ->assertSee('Tux')
            ->assertDontSee('Cartman');
    }

    public function test_sorting_a_collection_data_source(): void
    {
        Livewire::test(PetsCollectionTable::class)
            ->call('sortBy', 'age')
            ->assertSeeInOrder(['May', 'Ben', 'Chico', 'Tux', 'Cartman']);
    }

    public function test_filtering_a_collection_data_source(): void
    {
        Livewire::test(PetsCollectionTable::class)
            ->set('filterComponents.pet_name_filter', 'Ben')
            ->assertSee('Ben')
            ->assertDontSee('Cartman')
            ->assertDontSee('Tux');
    }

    public function test_pagination_of_a_collection_data_source(): void
    {
        Livewire::test(PetsCollectionTable::class)
            ->call('setPerPageAccepted', [2])
            ->call('setPerPage', 2)
            ->assertSee('Cartman')
            ->assertSee('Tux')
            ->assertDontSee('May')
            ->assertDontSee('Ben')
            ->assertDontSee('Chico');
    }
}
