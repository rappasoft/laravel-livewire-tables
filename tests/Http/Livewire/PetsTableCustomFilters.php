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

class PetsTableCustomFilters extends DataTableComponent
{
    public $model = Pet::class;

    public string $paginationTest = 'standard';

    public function enableDetailedPagination(string $type = 'standard')
    {
        $this->setPerPageAccepted([1, 3, 5, 10, 15, 25, 50])->setPerPage(3);
        $this->setPaginationMethod($type);
        $this->setDisplayPaginationDetailsEnabled();

    }

    public function disableDetailedPagination(string $type = 'standard')
    {
        $this->setPerPageAccepted([1, 3, 5, 10, 15, 25, 50])->setPerPage(3);
        $this->setPaginationMethod($type);
        $this->setDisplayPaginationDetailsDisabled();
    }

    public function setPaginationTest(string $type)
    {
        $this->paginationTest = $type;
    }

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
                })
                ->setPillsSeparator('<br />'),

        ];
    }
}
