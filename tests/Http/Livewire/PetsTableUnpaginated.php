<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Http\Livewire;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Tests\Models\Breed;
use Rappasoft\LaravelLivewireTables\Tests\Models\Pet;
use Rappasoft\LaravelLivewireTables\Tests\Models\Species;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\ImageColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateTimeFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\MultiSelectDropdownFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\MultiSelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\NumberFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;

class PetsTableUnpaginated extends PetsTable
{
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
                }),
            NumberFilter::make('Breed ID', 'breed_id_filter')
                ->filter(function (Builder $builder, string $value) {
                    return $builder->where('breed_id', '=', $value);
                }),

            TextFilter::make('Pet Name', 'pet_name_filter')
                ->filter(function (Builder $builder, string $value) {
                    return $builder->where('pets.name', '=', $value);
                }),

            DateFilter::make('Last Visit After Date', 'last_visit_date_filter')
                ->filter(function (Builder $builder, string $value) {
                    return $builder->whereDate('pets.last_visit', '=>', $value);
                }),

            DateTimeFilter::make('Last Visit Before DateTime', 'last_visit_datetime_filter')
                ->filter(function (Builder $builder, string $value) {
                    return $builder->whereDate('pets.last_visit', '<=', $value);
                }),

            SelectFilter::make('Breed SelectFilter', 'breed_select_filter')
                ->options(
                    Breed::query()
                        ->orderBy('name')
                        ->get()
                        ->keyBy('id')
                        ->map(fn ($breed) => $breed->name)
                        ->toArray()
                )
                ->filter(function (Builder $builder, string $value) {
                    return $builder->where('breed_id', $value);
                })
                ->setCustomFilterLabel('livewire-tables::tests.testFilterLabel')
                ->setFilterPillBlade('livewire-tables::tests.testFilterPills'),
        ];
    }
}
