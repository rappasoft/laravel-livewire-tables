<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Tests\Http\Livewire\Traits\TestHelpers;

abstract class BaseTable extends DataTableComponent
{
    use TestHelpers;

    public string $paginationTest = 'standard';

    /**
     * The suite configures tables through Livewire::test()->call('setX'), which the package
     * refuses for real tables. Tests of the refusal itself use their own fixtures.
     */
    public function browserCallableMethods(): array
    {
        return get_class_methods($this);
    }
}
