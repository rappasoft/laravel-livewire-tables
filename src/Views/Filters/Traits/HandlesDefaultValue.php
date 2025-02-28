<?php

namespace Rappasoft\LaravelLivewireTables\Views\Filters\Traits;

trait HandlesDefaultValue
{
    protected mixed $filterDefaultValue = null;

    /**
     * Sets a Default Value via the Filter Component
     *
     * @param  mixed  $value
     */
    public function setFilterDefaultValue($value): self
    {
        $this->filterDefaultValue = $value;

        return $this;
    }

    /**
     * Get the filter options.
     */
    public function getDefaultValue(): mixed
    {
        return null;
    }

    /**
     * Determines if the Filter has a Default Value via the Component
     */
    public function hasFilterDefaultValue(): bool
    {
        return ! is_null($this->filterDefaultValue);
    }
}
