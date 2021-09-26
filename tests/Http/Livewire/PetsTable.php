<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Http\Livewire;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Tests\Models\Pet;
use Rappasoft\LaravelLivewireTables\Views\Column;

class PetsTable extends DataTableComponent
{
    public function bulkActions(): array
    {
        return ['count' => 'Count selected'];
    }

    /**
     * @return Builder
     */
    public function query() : Builder
    {
        return Pet::query()
            ->with('species')
            ->with('breed');
    }

    public function columns(): array
    {
        return [
            Column::make('Name', 'name')
                ->searchable(),
            Column::make('Age', 'age')
                ->searchable(function (Builder $query, $search) {
                    $query->orWhere('age', '=', $search);
                }),
            Column::make('Last Visit', 'last_visit')
                ->searchable(),
            Column::make('Species', 'species.name')
                ->searchable(),
            Column::make('Breed', 'breed.name')
                ->searchable(),
        ];
    }

    public function count(): int
    {
        return $this->selectedRowsQuery()->count();
    }
}
