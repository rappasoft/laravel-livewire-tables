<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\FailingTables;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Tests\Models\{Breed,Pet,Species};
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\{ImageColumn,LinkColumn};
use Rappasoft\LaravelLivewireTables\Views\Filters\{DateFilter,DateTimeFilter,MultiSelectDropdownFilter,MultiSelectFilter,NumberFilter,SelectFilter,TextFilter};
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\BaseTable;

class BrokenSecondaryHeaderTable extends BaseTable
{
    public $model = Pet::class;


    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id')
                ->sortable()
                ->setSortingPillTitle('Key')
                ->setSortingPillDirections('0-9', '9-0'),

            Column::make('BrokenSecondaryHeader')->label(fn () => 'My Label')->secondaryHeader('Test123123'),

            Column::make('Sort')
                ->sortable()
                ->excludeFromColumnSelect(),
            Column::make('Name')
                ->sortable()
                ->secondaryHeader($this->getFilterByKey('pet_name_filter'))
                ->footerFilter('pet_name_filter')
                ->searchable(),

            Column::make('Age'),

            Column::make('Breed', 'breed.name')
                ->secondaryHeaderFilter('breed')
                ->footer($this->getFilterByKey('breed'))
                ->sortable(
                    fn (Builder $query, string $direction) => $query->orderBy('pets.id', $direction)
                )
                ->searchable(
                    fn (Builder $query, $searchTerm) => $query->orWhere('breed.name', $searchTerm)
                ),

            Column::make('Other')
                ->label(function ($row, Column $column) {
                    return 'Other';
                })
                ->footer(function ($rows) {
                    return 'Count: '.$rows->count();
                }),

            LinkColumn::make('Link')
                ->title(fn ($row) => 'Edit')
                ->location(fn ($row) => 'http://www.google.com')
                ->attributes(fn ($row) => [
                    'class' => 'rounded-full',
                    'alt' => $row->name.' Avatar',
                ]),
            ImageColumn::make('RowImg')
                ->location(fn ($row) => 'test'.$row->id)
                ->attributes(fn ($row) => [
                    'class' => 'rounded-full',
                    'alt' => $row->name.' Avatar',
                ]),
            Column::make('Last Visit', 'last_visit')
                ->sortable()
                ->deselected(),
        ];
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
