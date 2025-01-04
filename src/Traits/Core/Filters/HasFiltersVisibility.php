<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Core\Filters;

use Illuminate\Support\Collection;
use Livewire\Attributes\Locked;
use Rappasoft\LaravelLivewireTables\Views\Filter;

trait HasFiltersVisibility
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

    #[Locked]
    public bool $filtersVisibilityStatus = true;

    public function setFiltersVisibilityStatus(bool $status): self
    {
        $this->filtersVisibilityStatus = $status;

        return $this;
    }

    public function setFiltersVisibilityEnabled(): self
    {
        $this->setFiltersVisibilityStatus(true);

        return $this;
    }

    public function setFiltersVisibilityDisabled(): self
    {
        $this->setFiltersVisibilityStatus(false);

        return $this;
    }
}
