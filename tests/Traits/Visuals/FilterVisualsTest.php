<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Traits\Visuals;

use Livewire\Livewire;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\BreedsTable;
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

                ];
            }
        })
            ->set('filterComponents.species', [1, 2])
            ->assertSeeHtmlInOrder([
                'wire:key="table-filter-pill-species"',
                'Cat',
                '<br />',
                'Dog',
                '<br />',
            ])
            ->set('filterComponents.breed', [1, 2])
            ->assertSeeHtmlInOrder([
                'wire:key="table-filter-pill-breed"',
                'American Shorthair,',
                'Maine Coon',
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

    public function test_can_use_endswith_method(): void
    {

        Livewire::test(new class extends BreedsTable
        {
            public function configure(): void
            {
                $this->setPrimaryKey('id');
            }

            public function filters(): array
            {
                return [
                    \Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter::make('name')
                        ->setField('name')
                        ->endsWith(),
                ];
            }
        })
            ->assertSee('Persian')
            ->set('filterComponents.name', 'Coon')
            ->assertDontSee('Persian')
            ->assertSee('Coon');
    }

    public function test_can_use_notendswith_method(): void
    {

        Livewire::test(new class extends BreedsTable
        {
            public function configure(): void
            {
                $this->setPrimaryKey('id');
            }

            public function filters(): array
            {
                return [
                    \Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter::make('name')
                        ->setField('name')
                        ->notEndsWith(),
                ];
            }
        })
            ->assertSee('Maine Coon')
            ->set('filterComponents.name', 'Coon')
            ->assertDontSee('Maine Coon')
            ->assertSee('Persian');
    }

    public function test_can_use_startswith_method(): void
    {

        Livewire::test(new class extends BreedsTable
        {
            public function configure(): void
            {
                $this->setPrimaryKey('id');
            }

            public function filters(): array
            {
                return [
                    \Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter::make('name')
                        ->setField('name')
                        ->startsWith(),
                ];
            }
        })
            ->assertSee('Persian')
            ->set('filterComponents.name', 'Maine')
            ->assertDontSee('Persian')
            ->assertSee('Maine Coon');
    }

    public function test_can_use_notstartswith_method(): void
    {

        Livewire::test(new class extends BreedsTable
        {
            public function configure(): void
            {
                $this->setPrimaryKey('id');
            }

            public function filters(): array
            {
                return [
                    \Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter::make('name')
                        ->setField('name')
                        ->notStartsWith(),
                ];
            }
        })
            ->assertSee('Maine Coon')
            ->set('filterComponents.name', 'Maine')
            ->assertDontSee('Maine Coon')
            ->assertSee('Persian');
    }

    public function test_can_use_contains_method(): void
    {

        Livewire::test(new class extends BreedsTable
        {
            public function configure(): void
            {
                $this->setPrimaryKey('id');
            }

            public function filters(): array
            {
                return [
                    \Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter::make('name')
                        ->setField('name')
                        ->contains(),
                ];
            }
        })
            ->assertSee('Maine Coon')
            ->set('filterComponents.name', 'ne')
            ->assertSee('Maine Coon')
            ->assertDontSee('Persian');
    }

    public function test_can_use_not_contains_method(): void
    {

        Livewire::test(new class extends BreedsTable
        {
            public function configure(): void
            {
                $this->setPrimaryKey('id');
            }

            public function filters(): array
            {
                return [
                    \Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter::make('name')
                        ->notContains('name'),
                ];
            }
        })
            ->assertSee('Maine Coon')
            ->set('filterComponents.name', 'e C')
            ->assertDontSee('Maine Coon')
            ->assertSee('Persian');
    }
}
