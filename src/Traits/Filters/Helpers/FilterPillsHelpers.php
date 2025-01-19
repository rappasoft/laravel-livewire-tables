<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Filters\Helpers;

use Livewire\Attributes\Computed;
use Rappasoft\LaravelLivewireTables\Views\Filter;

trait FilterPillsHelpers
{
    #[Computed]
    public function showFilterPillsSection(): bool
    {
        return $this->filtersAreEnabled() && $this->filterPillsAreEnabled() && $this->hasAppliedVisibleFiltersForPills();
    }

    public function getFilterPillsStatus(): bool
    {
        return $this->filterPillsStatus;
    }

    public function filterPillsAreEnabled(): bool
    {
        return $this->getFilterPillsStatus() === true;
    }

    public function filterPillsAreDisabled(): bool
    {
        return $this->getFilterPillsStatus() === false;
    }

    public function hasAppliedVisibleFiltersForPills(): bool
    {
        return collect($this->getAppliedFiltersWithValues())
            ->map(fn ($_item, $key) => $this->getFilterByKey($key))
            ->reject(fn (Filter $filter) => $filter->isHiddenFromPills())
            ->count() > 0;
    }

}