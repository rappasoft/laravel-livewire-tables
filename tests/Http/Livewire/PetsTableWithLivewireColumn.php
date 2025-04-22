<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Http\Livewire;

use Illuminate\Support\Facades\App;
use Rappasoft\LaravelLivewireTables\Tests\Models\Pet;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\LivewireComponentColumn;

class PetsTableWithLivewireColumn extends BaseTable
{
    public $model = Pet::class;

    public function changeLocale(string $locale)
    {
        App::setLocale($locale);
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id')
                ->sortable(),
            Column::make('Name', 'name')
                ->sortable(),
            LivewireComponentColumn::make('LW', 'name')
                ->component('test-livewire-column-component')->attributes(function ($columnValue, $row) {
                    return [
                        'type' => 'test',
                        'name' => $row->name,
                    ];
                }),
        ];
    }
}
