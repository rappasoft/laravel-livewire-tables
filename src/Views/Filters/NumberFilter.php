<?php

namespace Rappasoft\LaravelLivewireTables\Views\Filters;

use Rappasoft\LaravelLivewireTables\Views\Filter;
use Rappasoft\LaravelLivewireTables\Views\Traits\Filters\{IsStringFilter};
use Rappasoft\LaravelLivewireTables\Views\Traits\Core\HasWireables;

class NumberFilter extends Filter
{
    use IsStringFilter;
    use HasWireables;

    protected string $view = 'livewire-tables::components.tools.filters.number';

    public function validate(mixed $value): float|int|bool
    {
        return is_numeric($value) ? $value : false;
    }
}
