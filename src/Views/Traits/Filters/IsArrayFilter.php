<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Filters;

use Closure;
use Illuminate\View\ComponentAttributeBag;
use Rappasoft\LaravelLivewireTables\Views\{Column,Filter};

trait IsArrayFilter
{
    /**
     * Get the filter default options.
     */
    public function getDefaultValue(): array
    {
        return [];
    }

    /**
     * Gets the Default Value for this Filter via the Component
     */
    public function getFilterDefaultValue(): array
    {
        return $this->filterDefaultValue ?? [];
    }

    public function isEmpty(array $value): bool
    {
        return ! is_array($value) || empty($value);
    }
}
