<?php

namespace Rappasoft\LaravelLivewireTables\Views\Filters;

use Rappasoft\LaravelLivewireTables\Views\Filter;

class NumberFilter extends Filter
{
    public string $view = 'livewire-tables::components.tools.filters.number';

    public function validate(mixed $value): int|bool
    {
        return is_numeric($value) ? $value : false;
    }

    public function isEmpty(?string $value): bool
    {
        return is_null($value) || $value === '';
    }

    /**
     * Gets the Default Value for this Filter via the Component
     */
    public function getFilterDefaultValue(): ?string
    {
        return $this->filterDefaultValue ?? null;
    }

}
