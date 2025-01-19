<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Filters\Helpers;

use Illuminate\Support\Collection;
use Rappasoft\LaravelLivewireTables\Views\Filter;

trait FilterVisibilityHelpers
{
    public function getFiltersVisibilityStatus(): bool
    {
        return $this->filtersVisibilityStatus;
    }

    public function filtersVisibilityIsEnabled(): bool
    {
        return $this->getFiltersVisibilityStatus() === true;
    }

    public function filtersVisibilityIsDisabled(): bool
    {
        return $this->getFiltersVisibilityStatus() === false;
    }

    public function hasVisibleFilters(): bool
    {
        return $this->getFilters()
            ->reject(fn (Filter $filter) => $filter->isHiddenFromMenus())
            ->count() > 0;
    }

    /**
     * Get whether filter has a configured slide down row.
     */
    public function getVisibleFilters(): Collection
    {
        return $this->getFilters()->reject(fn (Filter $filter) => $filter->isHiddenFromMenus());
    }
}
