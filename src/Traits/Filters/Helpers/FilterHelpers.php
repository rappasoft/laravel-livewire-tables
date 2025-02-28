<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Filters\Helpers;

use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Rappasoft\LaravelLivewireTables\Views\Filter;

trait FilterHelpers
{
    public function hasFilters(): bool
    {
        return $this->getFiltersCount() > 0;
    }

    public function getFilters(): Collection
    {
        if (! isset($this->filterCollection)) {
            $this->filterCollection = collect($this->filters());
        }

        return $this->filterCollection;
    }

    public function getFiltersCount(): int
    {
        if (! isset($this->filterCount)) {
            $this->filterCount = $this->getFilters()->count();
        }

        return $this->filterCount;
    }

    /**
     * @return mixed
     */
    public function getFilterByKey(string $key)
    {
        return $this->getFilters()->first(function ($filter) use ($key) {
            return $filter->getKey() === $key;
        });
    }

    /**
     * @return array<mixed>
     */
    public function getAppliedFilters(): array
    {
        $validFilterKeys = $this->getFilters()
            ->map(fn (Filter $filter) => $filter->getKey())
            ->toArray();

        return collect($this->filterComponents ?? [])
            ->filter(fn ($value, $key) => in_array($key, $validFilterKeys, true))
            ->toArray();
    }

    public function hasAppliedFiltersWithValues(): bool
    {
        return count($this->getAppliedFiltersWithValues()) > 0;
    }

    public function hasAppliedVisibleFiltersWithValuesThatCanBeCleared(): bool
    {
        return collect($this->getAppliedFiltersWithValues())
            ->map(fn ($_item, $key) => $this->getFilterByKey($key))
            ->reject(fn (Filter $filter) => $filter->isHiddenFromMenus() && ! $filter->isResetByClearButton())
            ->count() > 0;
    }

    public function getFilterBadgeCount(): int
    {
        return collect($this->getAppliedFiltersWithValues())
            ->map(fn ($_item, $key) => $this->getFilterByKey($key))
            ->reject(fn (Filter $filter) => $filter->isHiddenFromFilterCount())
            ->count();
    }

    /**
     * @return array<mixed>
     */
    /*public function getAppliedFiltersWithValuesOld(): array
    {
        return $this->appliedFilters = array_filter($this->getAppliedFilters(), function ($item, $key) {
            return ! $this->getFilterByKey($key)->isEmpty($item) && (is_array($item) ? count($item) : $item !== null);
        }, ARRAY_FILTER_USE_BOTH);
    }*/

    /**
     * @return array<mixed>
     */
    public function getAppliedFiltersWithValues(): array
    {
        return $this->appliedFilters = array_filter($this->getAppliedFilters(), function ($item, $key) {
            $filter = $this->getFilterByKey($key);
            $item = (! is_null($item) && ! $filter->isEmpty($item)) ? $filter->validate($item) : $item;

            return ! $filter->isEmpty($item) && (is_array($item) ? count($item) : $item !== null);
        }, ARRAY_FILTER_USE_BOTH);
    }

    /**
     * @return mixed
     */
    public function getAppliedFilterWithValue(string $filterKey)
    {
        return $this->getAppliedFiltersWithValues()[$filterKey] ?? null;
    }

    public function getAppliedFiltersWithValuesCount(): int
    {
        return count($this->getAppliedFiltersWithValues());
    }

    public function getAppliedFiltersCollection(): Collection
    {
        $validFilterKeys = $this->getFilters()
            ->map(fn (Filter $filter) => $filter->getKey())
            ->toArray();

        return collect($this->filterComponents ?? [])
            ->filter(fn ($value, $key) => in_array($key, $validFilterKeys, true));
    }
}
