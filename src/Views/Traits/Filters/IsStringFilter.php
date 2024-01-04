<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Filters;

use Closure;
use Illuminate\View\ComponentAttributeBag;
use Rappasoft\LaravelLivewireTables\Views\{Column,Filter};

trait IsStringFilter
{
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
