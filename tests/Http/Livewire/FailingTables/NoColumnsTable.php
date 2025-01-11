<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\FailingTables;

use Rappasoft\LaravelLivewireTables\Tests\Models\Pet;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\PetsTable;

class NoColumnsTable extends PetsTable
{
    public $model = Pet::class;

    public function columns(): array
    {
        return [
        ];
    }

}
