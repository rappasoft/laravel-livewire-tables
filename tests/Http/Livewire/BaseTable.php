<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\Traits\TestHelpers;

abstract class BaseTable extends DataTableComponent
{
    use TestHelpers;

    public string $paginationTest = 'standard';
}
