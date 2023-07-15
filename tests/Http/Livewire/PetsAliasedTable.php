<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Http\Livewire;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Tests\Models\Pet;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\ImageColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class PetsAliasedTable extends DataTableComponent
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
                ->setAlias('my_id')
                ->sortable()
                ->setSortingPillTitle('Key')
                ->setSortingPillDirections('0-9', '9-0'),
            Column::make('Sort')
                ->setAlias('my_sort')
                ->sortable()
                ->excludeFromColumnSelect(),
            Column::make('Name')
                ->setAlias('my_name')
                ->sortable()
                ->secondaryHeader($this->getFilterByKey('pet_name_filter'))
                ->footerFilter('pet_name_filter')
                ->searchable(),

            Column::make('Age', null, 'my_age')
                ->setAlias('my_age'),

            Column::make('Breed', 'breed.name')
                ->setAlias('my_breed')
                ->secondaryHeaderFilter('breed')
                ->footer($this->getFilterByKey('breed'))
                ->sortable(
                    fn (Builder $query, string $direction) => $query->orderBy('pets.id', $direction)
                )
                ->searchable(
                    fn (Builder $query, $searchTerm) => $query->orWhere('breeds.name', $searchTerm)
                ),

            Column::make('Other')
                ->setAlias('my_other')
                ->label(function ($row, Column $column) {
                    return 'Other';
                })
                ->footer(function ($rows) {
                    return 'Count: '.$rows->count();
                }),

            LinkColumn::make('Link')
                ->setAlias('my_link')
                ->title(fn ($row) => 'Edit')
                ->location(fn ($row) => 'http://www.google.com')
                ->attributes(fn ($row) => [
                    'class' => 'rounded-full',
                    'alt' => $row->name.' Avatar',
                ]),
            ImageColumn::make('RowImg')
                ->setAlias('my_image')
                ->location(fn ($row) => 'test'.$row->id)
                ->attributes(fn ($row) => [
                    'class' => 'rounded-full',
                    'alt' => $row->name.' Avatar',
                ]),
        ];
    }
}
