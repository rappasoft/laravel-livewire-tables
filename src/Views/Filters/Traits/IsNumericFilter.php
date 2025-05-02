<?php

namespace Rappasoft\LaravelLivewireTables\Views\Filters\Traits;

trait IsNumericFilter
{
    public function isEmpty(float|int|string|array|null $value): bool
    {
        return ! is_null($value) ? ($this->validate($value) === false) : true;
    }

    /**
     * Gets the Default Value for this Filter via the Component
     */
    public function getFilterDefaultValue(): ?string
    {
        return $this->filterDefaultValue ?? null;
    }
}
