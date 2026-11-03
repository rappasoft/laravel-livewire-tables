<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Http\Livewire;

use Illuminate\Support\Collection;
use Rappasoft\LaravelLivewireTables\Tests\Models\Pet;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;

class PetsCollectionTable extends BaseTable
{
    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function collection(): ?Collection
    {
        return Pet::query()->get();
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id')
                ->sortable(),
            Column::make('Name')
                ->sortable()
                ->searchable(),
            Column::make('Age')
                ->sortable(),
        ];
    }

    public function filters(): array
    {
        return [
            TextFilter::make('Pet Name', 'pet_name_filter')
                ->filter(function (Collection $items, string $value) {
                    return $items->filter(fn ($row) => $row->name === $value);
                }),
        ];
    }
}
