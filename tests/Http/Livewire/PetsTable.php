<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Http\Livewire;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Tests\Models\Pet;
use Rappasoft\LaravelLivewireTables\Views\Column;

class PetsTable extends DataTableComponent
{
    /**
     * @return Builder
     */
    public function query() : Builder
    {
        return Pet::query()->when($this->getFilter('search'), function (Builder $query, $search){
            $query->where('name', 'like', '%'.$search.'%');
        });
    }

    public function columns(): array
    {
        return [
            Column::make('Name', 'name'),
            Column::make('Age', 'age'),
            Column::make('Last Visit', 'last_visit'),
            Column::make('Species', 'species.name'),
            Column::make('Breed', 'breed.name'),
        ];
    }
}
