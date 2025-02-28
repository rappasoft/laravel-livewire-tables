<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Filters\Helpers;

use Livewire\Attributes\Computed;
use Rappasoft\LaravelLivewireTables\Views\Filter;
use Rappasoft\LaravelLivewireTables\Views\Filters\BooleanFilter;

trait FilterPillsHelpers
{
    #[Computed]
    public function showFilterPillsSection(): bool
    {
        return $this->filtersAreEnabled() && $this->filterPillsAreEnabled() && ($this->getAppliedFiltersWithValuesForPillsCount() > 0);
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

    /**
     * @return array<mixed>
     */
    public function getAppliedFiltersWithValuesForPills(): array
    {
        return $this->appliedFilters = array_filter($this->getAppliedFilters(), function ($item, $key) {
            $filter = $this->getFilterByKey($key);
            if ($filter->isHiddenFromPills() || is_null($item)) {
                return false;
            }

            $validatedValue = $filter->validate($item);

            if ($filter instanceof BooleanFilter) {
                return ! ($filter->isEmpty($validatedValue));
            } elseif ($validatedValue === null || $validatedValue === 'null' || $filter->isEmpty($validatedValue)) {
                return false;
            } elseif (is_array($validatedValue)) {
                $filter->isEmpty($validatedValue);
                if (array_key_exists(0, $validatedValue) && (is_null($validatedValue[0]) || $validatedValue[0] == 'null')) {
                    return false;
                }
            }

            return is_array($validatedValue) ? count($validatedValue) : $validatedValue !== null;
        }, ARRAY_FILTER_USE_BOTH);
    }

    public function getAppliedFiltersWithValuesForPillsCount(): int
    {
        return count($this->getAppliedFiltersWithValuesForPills());

    }
}
