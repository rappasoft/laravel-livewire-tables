<?php

namespace Rappasoft\LaravelLivewireTables\Views\Filters;

use Rappasoft\LaravelLivewireTables\Views\Filter;
use Rappasoft\LaravelLivewireTables\Views\Traits\Core\HasWireables;
use Rappasoft\LaravelLivewireTables\Views\Traits\Filters\{IsNumericFilter};

class NumberFilter extends Filter
{
    use IsNumericFilter;
    use HasWireables;

    public string $wireMethod = 'blur';

    protected string $view = 'livewire-tables::components.tools.filters.number';

    public function validate(float|int|string|array $value): float|int|string|false
    {
        $floatValue = (float) $value;
        $intValue = (int) $value;

        if (is_array($value)) {
            return false;
        } elseif (is_float($value)) {
            return $floatValue;
        } elseif (is_int($value)) {
            return $intValue;
        } elseif(is_numeric($value)) {
            return (($floatValue - $intValue) == 0) ? $intValue : $floatValue;
        } else if (ctype_digit($value)) {
            return $intValue;
        }
        return false;
    }
}
