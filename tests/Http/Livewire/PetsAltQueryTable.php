<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Http\Livewire;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Tests\Models\Pet;
use Rappasoft\LaravelLivewireTables\Views\Column;

class PetsAltQueryTable extends DataTableComponent
{
    /**
     * @return Builder
     */
    public function query() : Builder
    {
        return Pet::query()->select('pets.name', 'pets.age', 'pets.last_visit', 'species.name', 'breeds.name')
                            ->join('species', 'pets.species_id', '=', 'species.id')
                            ->join('breeds', 'breed_id', '=', 'breeds.id');
    }

    public function columns(): array
    {
        return [
            Column::make('Name', 'name')
                ->searchable(),
            Column::make('Age', 'age')
                ->searchable(),
            Column::make('Last Visit', 'last_visit')
                ->searchable(),
            Column::make('Species', 'species.name')
                ->searchable(),
            Column::make('Breed', 'breed.name')
                ->searchable(),
        ];
    }
}
