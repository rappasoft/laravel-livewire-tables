<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Visuals;

use Livewire\Livewire;
use PHPUnit\Framework\Attributes\Group;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\PetsTable;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\PetsTableNoFilters;
use Rappasoft\LaravelLivewireTables\Tests\TestCase;

#[Group('Visuals')]
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

    public function test_event_dispatched_when_filter_components_set(): void
    {
        Livewire::test(PetsTable::class)
            ->set('filterComponents.breed', [1])
            ->assertDispatched('filter-was-set');
    }

    public function test_event_dispatched_when_set_filter_dispatched(): void
    {
        Livewire::test(PetsTable::class)
            ->dispatch('setFilter', filterKey: 'breed', value: [1])
            ->assertDispatched('filter-was-set');
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
                $this->setPrimaryKey('id');
            }

            public function filters(): array
            {
                return [
                    \Rappasoft\LaravelLivewireTables\Views\Filters\MultiSelectFilter::make('Breed')
                        ->options(
                            \Rappasoft\LaravelLivewireTables\Tests\Models\Breed::query()
                                ->orderBy('name')
                                ->get()
                                ->keyBy('id')
                                ->map(fn ($breed) => $breed->name)
                                ->toArray()
                        )
                        ->filter(function (\Illuminate\Database\Eloquent\Builder $builder, array $values) {
                            return $builder->whereIn('pets.breed_id', $values);
                        }),
                    \Rappasoft\LaravelLivewireTables\Views\Filters\MultiSelectDropdownFilter::make('Species')
                        ->options(
                            \Rappasoft\LaravelLivewireTables\Tests\Models\Species::query()
                                ->orderBy('name')
                                ->get()
                                ->keyBy('id')
                                ->map(fn ($species) => $species->name)
                                ->toArray()
                        )
                        ->filter(function (\Illuminate\Database\Eloquent\Builder $builder, array $values) {
                            return $builder->whereIn('pets.species_id', $values);
                        })
                        ->setPillsSeparator('<br />'),

                    \Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter::make('Pet Name', 'pet_name_filter')
                        ->filter(function (\Illuminate\Database\Eloquent\Builder $builder, string $value) {
                            return $builder->where('pets.name', '=', $value);
                        }),
                ];
            }
        })
            ->set('filterComponents.species', [1, 2])
            ->assertSeeHtmlInOrder([
                'wire:key="table-filter-pill-species"',
                'Cat',
                '<br />',
                'Dog',
            ])
            ->set('filterComponents.breed', [1, 2])
            ->assertSeeHtmlInOrder([
                'wire:key="table-filter-pill-breed"',
                'American Shorthair,',
                'Maine Coon',
            ]);
    }

    public function test_filters_popover_menu_is_customisable(): void
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
                    \Rappasoft\LaravelLivewireTables\Views\Filters\MultiSelectFilter::make('Breed')
                        ->options(
                            \Rappasoft\LaravelLivewireTables\Tests\Models\Breed::query()
                                ->orderBy('name')
                                ->get()
                                ->keyBy('id')
                                ->map(fn ($breed) => $breed->name)
                                ->toArray()
                        )
                        ->filter(function (\Illuminate\Database\Eloquent\Builder $builder, array $values) {
                            return $builder->whereIn('pets.breed_id', $values);
                        }),
                    \Rappasoft\LaravelLivewireTables\Views\Filters\MultiSelectDropdownFilter::make('Species')
                        ->options(
                            \Rappasoft\LaravelLivewireTables\Tests\Models\Species::query()
                                ->orderBy('name')
                                ->get()
                                ->keyBy('id')
                                ->map(fn ($species) => $species->name)
                                ->toArray()
                        )
                        ->filter(function (\Illuminate\Database\Eloquent\Builder $builder, array $values) {
                            return $builder->whereIn('pets.species_id', $values);
                        })
                        ->setPillsSeparator('<br />'),

                    \Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter::make('Pet Name', 'pet_name_filter')
                        ->filter(function (\Illuminate\Database\Eloquent\Builder $builder, string $value) {
                            return $builder->where('pets.name', '=', $value);
                        }),
                ];
            }
        })
            ->assertSeeHtmlInOrder([
                'class="w-full md:w-56 origin-top-left absolute left-0 mt-2 rounded-md shadow-lg ring-1 ring-opacity-5 divide-y focus:outline-none z-50 bg-white divide-gray-100 ring-black dark:bg-gray-700 dark:text-white dark:divide-gray-600"',
            ])
            ->call('setFilterPopoverAttributes', ['class' => 'w-96', 'default-width' => false])
            ->assertSeeHtmlInOrder([
                'class="origin-top-left absolute left-0 mt-2 rounded-md shadow-lg ring-1 ring-opacity-5 divide-y focus:outline-none z-50 bg-white divide-gray-100 ring-black dark:bg-gray-700 dark:text-white dark:divide-gray-600 w-96"',
            ])
            ->call('setFilterPopoverAttributes', ['class' => 'w-96', 'default-width' => false, 'default-colors' => false])
            ->assertSeeHtmlInOrder([
                'class="origin-top-left absolute left-0 mt-2 rounded-md shadow-lg ring-1 ring-opacity-5 divide-y focus:outline-none z-50 w-96"',
            ]);

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
