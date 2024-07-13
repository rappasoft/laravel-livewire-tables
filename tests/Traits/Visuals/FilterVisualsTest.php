<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Traits\Visuals;

use Livewire\Livewire;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\PetsTable;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\PetsTableNoFilters;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;

final class FilterVisualsTest extends TestCase
{
    public function test_filters_button_shows_when_enabled(): void
    {
        Livewire::test(PetsTable::class)
            ->assertSee('Filters');
    }

    public function test_filters_button_shows_when_visible(): void
    {
        Livewire::test(PetsTable::class)
            ->call('setFiltersVisibilityEnabled')
            ->assertSee('Filters');
    }

    public function test_filters_button_doesnt_show_when_disabled(): void
    {
        Livewire::test(PetsTable::class)
            ->call('setFiltersDisabled')
            ->assertDontSee('Filters');
    }

    public function test_filters_button_doesnt_show_when_hidden(): void
    {
        Livewire::test(PetsTable::class)
            ->call('setFiltersVisibilityDisabled')
            ->assertDontSee('Filters');
    }

    public function test_filters_button_dont_show_when_there_are_no_filters_defined(): void
    {
        Livewire::test(PetsTableNoFilters::class)
            ->assertDontSee('Filters');
    }

    public function test_filter_pills_show_when_enabled(): void
    {
        Livewire::test(PetsTable::class)
            ->set('filterComponents.breed', [1])
            ->assertSee('Applied Filters');
    }

    public function test_filter_pills_show_when_visible(): void
    {
        Livewire::test(PetsTable::class)
            ->call('setFiltersVisibilityEnabled')
            ->set('filterComponents.breed', [1])
            ->assertSee('Applied Filters');
    }

    public function test_filter_pills_dont_show_when_disabled(): void
    {
        Livewire::test(PetsTable::class)
            ->set('filterComponents.breed', [1])
            ->call('setFilterPillsDisabled')
            ->assertDontSee('Applied Filters');
    }

    public function test_filter_pills_dont_show_when_hidden(): void
    {
        Livewire::test(PetsTable::class)
            ->set('filterComponents.breed', [1])
            ->call('setFilterPillsDisabled')
            ->assertDontSee('Applied Filters');
    }

    public function test_filter_pills_dont_show_when_no_filters_are_applied(): void
    {
        Livewire::test(PetsTable::class)
            ->assertDontSee('Applied Filters');
    }

    public function test_filters_with_invalid_key_dont_error(): void
    {
        Livewire::test(PetsTable::class)
            ->set('filterComponents.invalid-filter', [1])
            ->assertHasNoErrors()
            ->assertDontSee('Applied Filters');
    }

    public function test_filters_pills_separator_is_customisable(): void
    {
        Livewire::test(new class extends PetsTable
        {
            public function configure(): void
            {
                $this->setPrimaryKey('id')
                    ->setShouldAlwaysHideBulkActionsDropdownOptionEnabled();
            }

            public function bulkActions(): array
            {
                return ['exportBulk' => 'exportBulk'];
            }

            public function exportBulk($items)
            {
                return $items;
            }
        })->set('filterComponents.invalid-filter', [1])
            ->assertHasNoErrors()
            ->assertDontSee('Applied Filters');
    }

    public function test_filters_pills_separator_is_customisable(): void
    {
        Livewire::test(new class extends PetsTable
        {
            public function configure(): void
            {
                $this->setPrimaryKey('id');
            }

            public function filters(): array
            {
                return [
                    MultiSelectFilter::make('Breed')
                        ->options(
                            Breed::query()
                                ->orderBy('name')
                                ->get()
                                ->keyBy('id')
                                ->map(fn ($breed) => $breed->name)
                                ->toArray()
                        )
                        ->filter(function (Builder $builder, array $values) {
                            return $builder->whereIn('breed_id', $values);
                        }),
                    MultiSelectDropdownFilter::make('Species')
                        ->options(
                            Species::query()
                                ->orderBy('name')
                                ->get()
                                ->keyBy('id')
                                ->map(fn ($species) => $species->name)
                                ->toArray()
                        )
                        ->filter(function (Builder $builder, array $values) {
                            return $builder->whereIn('species_id', $values);
                        })
                        ->setPillsSeparator('<br />'),

                ];
            }
        })
            ->set('filterComponents.species', [1, 2])
            ->assertDontSee('Bulk Actions');
    }

    /*public function test_filter_events_apply_correctly(): void
    {
        Livewire::test(PetsTable::class)
            ->assertDontSee('Applied Filters')
            ->emit('setFilter', 'breed', [1])
            ->assertSee('Applied Filters')
            ->emit('clearFilters')
            ->assertDontSee('Applied Filters');
    }*/
}
