<?php

namespace Rappasoft\LaravelLivewireTables\Views\Filters;

use Rappasoft\LaravelLivewireTables\Views\Filter;
use Rappasoft\LaravelLivewireTables\Views\Filters\Traits\{HasWireables, IsNumericFilter};

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
        } elseif (is_numeric($value)) {
            return (($floatValue - $intValue) == 0) ? $intValue : $floatValue;
        } elseif (ctype_digit($value)) {
            return $intValue;
        }

        return false;
    }

    protected function getCoreInputAttributes(): array
    {
        $attributes = array_merge(parent::getCoreInputAttributes(),
            [
                'min' => $this->hasConfig('min') ? $this->getConfig('min') : null,
                'max' => $this->hasConfig('max') ? $this->getConfig('max') : null,
                'placeholder' => $this->hasConfig('placeholder') ? $this->getConfig('placeholder') : null,
                'type' => 'number',
                'wire:key' => $this->generateWireKey($this->getGenericDisplayData()['tableName'], 'number'),

            ]);
        ksort($attributes);

        return $attributes;
    }
}
