<?php

namespace Rappasoft\LaravelLivewireTables\Filters;

use Rappasoft\LaravelLivewireTables\Filters\Traits\HasOptions;

class BooleanFilter extends BaseFilter
{
    use HasOptions;

    public $type = 'boolean';

    public $view = 'boolean-filter';

    public function passValuesFromRequestToFilter($values): array
    {
        $options = collect($this->options())->values()->toArray();
        $valuesToFilter = [];

        foreach ($options as $option) {
            if (isset($values[$option]) && filter_var($values[$option], FILTER_VALIDATE_BOOLEAN)) {
                $valuesToFilter[$option] = true;
            } else {
                $valuesToFilter[$option] = false;
            }
        }

        return $valuesToFilter;
    }

    public function isChecked($option): bool
    {
        $values = $this->selected();

        return isset($values[$option]) && $values[$option];
    }
}
