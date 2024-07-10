<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Tests\Models\Species;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\{AvgColumn,CountColumn,SumColumn};

class SpeciesTable extends DataTableComponent
{
    public $model = Species::class;

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
            Column::make('Name')
                ->sortable()
                ->searchable(),
            AvgColumn::make('Average Age')
                ->setDataSource('pets','age'),
            CountColumn::make('Number of Pets')
                ->setDataSource('pets'),
            SumColumn::make('Total Age')
                ->setDataSource('pets','age'),

        ];
    }
}
