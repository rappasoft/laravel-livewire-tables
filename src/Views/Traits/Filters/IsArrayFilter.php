<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Filters;

use Closure;
use Illuminate\View\ComponentAttributeBag;
use Rappasoft\LaravelLivewireTables\Views\{Column,Filter};

trait IsArrayFilter
{
    public string $pillsSeparator = ', ';

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

    public function isEmpty(mixed $value): bool
    {
        if (! is_array($value)) {
            return true;
        }

        return empty($value);
    }

    public function getPillsSeparator(): string
    {
        return $this->pillsSeparator ?? ', ';
    }

    public function setPillsSeparator(string $pillsSeparator): self
    {
        $this->pillsSeparator = $pillsSeparator;

        return $this;
    }
}
