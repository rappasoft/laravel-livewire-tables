<?php


namespace Rappasoft\LaravelLivewireTables\Tests\Http\Livewire;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Tests\Models\Species;
use Rappasoft\LaravelLivewireTables\Views\Column;

class CatsTable extends DataTableComponent
{
    public array $bulkActions = [
        'feed' => 'Feed selected',
    ];

    public function query(): Relation
    {
        /** @var Species $dogSpecimen */
        $dogSpecimen = Species::query()->where('name', 'Cat')->first();

        return $dogSpecimen->pets()->with('species')->with('breed');
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

    public function feed(): int{
        return $this->selectedRowsQuery()->count();
    }
}
