<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Http\Livewire;

use Livewire\Component;
use Rappasoft\LaravelLivewireTables\Views\Filters\Traits\IsExternalArrayFilter;

class TestExternalArrayFilter extends Component
{
    use IsExternalArrayFilter;

    public function mount(): void
    {
        $this->tableName = 'table';
        $this->filterKey = 'breed';
        $this->tableComponent = PetsTable::class;
        $this->selectOptions = [4 => 'Norwegian Forest', 102 => 'Red Setter'];
    }

    public function render(): string
    {
        return '<div></div>';
    }
}
