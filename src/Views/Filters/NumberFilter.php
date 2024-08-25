<?php

namespace Rappasoft\LaravelLivewireTables\Views\Filters;

use Rappasoft\LaravelLivewireTables\Views\Filter;
use Rappasoft\LaravelLivewireTables\Views\Traits\Core\HasWireables;
use Rappasoft\LaravelLivewireTables\Views\Traits\Filters\{IsStringFilter};

class NumberFilter extends Filter
{
    use IsStringFilter;
    use HasWireables;

    public string $wireMethod = 'blur';

    protected string $view = 'livewire-tables::components.tools.filters.number';

    public function validate(float|int|string|array $value): float|int|string|false
    {
        if (is_array($value)) {
            return false;
        } elseif (is_float($value)) {
            return (float) $value;
        } elseif (is_int($value)) {
            return (int) $value;
        }

        return false;
    }
}
