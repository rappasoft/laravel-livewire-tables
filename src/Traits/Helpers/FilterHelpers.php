<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Helpers;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Rappasoft\LaravelLivewireTables\Views\Filter;
use Rappasoft\LaravelLivewireTables\Views\Filters\MultiSelectDropdownFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\MultiSelectFilter;

trait FilterHelpers
{
    /**
     * @return bool
     */
    public function getFiltersStatus(): bool
    {
        return $this->filtersStatus;
    }

    /**
     * @return bool
     */
    public function filtersAreEnabled(): bool
    {
        return $this->getFiltersStatus() === true;
    }

    /**
     * @return bool
     */
    public function filtersAreDisabled(): bool
    {
        return $this->getFiltersStatus() === false;
    }

    /**
     * @return bool
     */
    public function getFiltersVisibilityStatus(): bool
    {
        return $this->filtersVisibilityStatus;
    }

    /**
     * @return bool
     */
    public function filtersVisibilityIsEnabled(): bool
    {
        return $this->getFiltersVisibilityStatus() === true;
    }

    /**
     * @return bool
     */
    public function filtersVisibilityIsDisabled(): bool
    {
        return $this->getFiltersVisibilityStatus() === false;
    }

    /**
     * @return bool
     */
    public function getFilterSlideDownDefaultStatus(): bool
    {
        return $this->filterSlideDownDefaultVisible;
    }

    /**
     * @return bool
     */
    public function filtersSlideDownIsDefaultVisible(): bool
    {
        return $this->getFilterSlideDownDefaultStatus() === true;
    }

    /**
     * @return bool
     */
    public function filtersSlideDownIsDefaultHidden(): bool
    {
        return $this->getFilterSlideDownDefaultStatus() === false;
    }

    /**
     * @return bool
     */
    public function getFilterPillsStatus(): bool
    {
        return $this->filterPillsStatus;
    }

    /**
     * @return bool
     */
    public function filterPillsAreEnabled(): bool
    {
        return $this->getFilterPillsStatus() === true;
    }

    /**
     * @return bool
     */
    public function filterPillsAreDisabled(): bool
    {
        return $this->getFilterPillsStatus() === false;
    }

    /**
     * @return bool
     */
    public function hasFilters(): bool
    {
        return ($this->getFilters()->count() > 0);
    }

    /**
     * @return bool
     */
    public function hasVisibleFilters(): bool
    {
        return ($this->getFilters()
            ->reject(fn (Filter $filter) => $filter->isHiddenFromMenus())
            ->count() > 0);
    }

    /**
     * @return Collection
     */
    public function getFilters(): Collection
    {
        return collect($this->filters());
    }

    /**
     * @return int
     */
    public function getFiltersCount(): int
    {
        return $this->getFilters()->count();
    }

    /**
     * @param string $key
     *
     * @return mixed
     */
    public function getFilterByKey(string $key)
    {
        return $this->getFilters()->first(function ($filter) use ($key) {
            return $filter->getKey() === $key;
        });
    }

    /**
     * @param string $filterKey
     * @param mixed $value
     *
     * @return mixed
     */
    public function setFilter(string $filterKey, $value)
    {
        return $this->{$this->getTableName()}['filters'][$filterKey] = $value;
    }

    /**
     * @param string $filterKey
     *
     * @return void
     */
    public function selectAllFilterOptions(string $filterKey): void
    {
        $filter = $this->getFilterByKey($filterKey);

        if (! $filter instanceof MultiSelectFilter && ! $filter instanceof MultiSelectDropdownFilter) {
            return;
        }

        if (count($this->getAppliedFilterWithValue($filterKey) ?? []) === count($filter->getOptions())) {
            $this->resetFilter($filterKey);

            return;
        }

        $this->setFilter($filterKey, array_keys($filter->getOptions()));
    }

    /**
     * @return void
     */
    public function setFilterDefaults(): void
    {
        foreach ($this->getFilters() as $filter) {
            if ($filter->isResetByClearButton()) {
                $this->resetFilter($filter);
            }
        }
    }

    /**
     * @return array<mixed>
     */
    public function getAppliedFilters(): array
    {
        $validFilterKeys = $this->getFilters()
            ->map(fn (Filter $filter) => $filter->getKey())
            ->toArray();

        return collect($this->{$this->getTableName()}['filters'] ?? [])
            ->filter(fn ($value, $key) => in_array($key, $validFilterKeys, true))
            ->toArray();
    }

    /**
     * @return bool
     */
    public function hasAppliedFiltersWithValues(): bool
    {
        return count($this->getAppliedFiltersWithValues()) > 0;
    }

    /**
     * @return bool
     */
    public function hasAppliedVisibleFiltersWithValuesThatCanBeCleared(): bool
    {
        return (collect($this->getAppliedFiltersWithValues())
            ->map(fn ($_item, $key) => $this->getFilterByKey($key))
            ->reject(fn (Filter $filter) => $filter->isHiddenFromMenus() && ! $filter->isResetByClearButton())
            ->count() > 0);
    }

    /**
     * @return int
     */
    public function getFilterBadgeCount(): int
    {
        return collect($this->getAppliedFiltersWithValues())
            ->map(fn ($_item, $key) => $this->getFilterByKey($key))
            ->reject(fn (Filter $filter) => $filter->isHiddenFromFilterCount())
            ->count();
    }

    /**
     * @return bool
     */
    public function hasAppliedVisibleFiltersForPills(): bool
    {
        return (collect($this->getAppliedFiltersWithValues())
            ->map(fn ($_item, $key) => $this->getFilterByKey($key))
            ->reject(fn (Filter $filter) => $filter->isHiddenFromPills())
            ->count() > 0);
    }

    /**
     * @return array<mixed>
     */
    public function getAppliedFiltersWithValues(): array
    {
        return array_filter($this->getAppliedFilters(), function ($item, $key) {
            return ! $this->getFilterByKey($key)->isEmpty($item) && (is_array($item) ? count($item) : $item !== null);
        }, ARRAY_FILTER_USE_BOTH);
    }

    /**
     * @param string $filterKey
     *
     * @return mixed
     */
    public function getAppliedFilterWithValue(string $filterKey)
    {
        return $this->getAppliedFiltersWithValues()[$filterKey] ?? null;
    }

    /**
     * @return int
     */
    public function getAppliedFiltersWithValuesCount(): int
    {
        return count($this->getAppliedFiltersWithValues());
    }

    /**
     * @param mixed $filter
     *
     * @return void
     */
    public function resetFilter($filter): void
    {
        if (! $filter instanceof Filter) {
            $filter = $this->getFilterByKey($filter);
        }

        $this->setFilter($filter->getKey(), $filter->getDefaultValue());
    }

    /**
     * @return string
     */
    public function getFilterLayout(): string
    {
        return $this->filterLayout;
    }

    /**
     * @return bool
     */
    public function isFilterLayoutPopover(): bool
    {
        return $this->getFilterLayout() === 'popover';
    }

    /**
     * @return bool
     */
    public function isFilterLayoutSlideDown(): bool
    {
        return $this->getFilterLayout() === 'slide-down';
    }

    /**
     * Get whether any filter has a configured slide down row.
     *
     * @return bool
     */
    public function hasFiltersWithSlidedownRows(): bool
    {
        return ($this->getFilters()
        ->reject(fn (Filter $filter) => ! $filter->hasFilterSlidedownRow())
        ->count() > 0);
    }

    /**
     * Get whether filter has a configured slide down row.
     *
     * @return Collection
     */
    public function getVisibleFilters(): Collection
    {
        return $this->getFilters()->reject(fn (Filter $filter) => $filter->isHiddenFromMenus());
    }

    /**
     * Get filters sorted by row
     *
     * @return array<mixed>
     */
    public function getFiltersByRow(): array
    {
        $orderedFilters = [];
        $filterList = ($this->hasFiltersWithSlidedownRows()) ? $this->getVisibleFilters()->sortBy('filterSlidedownRow') : $this->getVisibleFilters();
        if ($this->hasFiltersWithSlidedownRows()) {
            foreach ($filterList as $filter) {
                $orderedFilters[(string) $filter->getFilterSlidedownRow()][] = $filter;
            }

            if (empty($orderedFilters['1'])) {
                $orderedFilters['1'] = (isset($orderedFilters['99']) ? $orderedFilters['99'] : []);
                if (isset($orderedFilters['99'])) {
                    unset($orderedFilters['99']);
                }
            }
        } else {
            $orderedFilters = Arr::wrap($filterList);
            $orderedFilters['1'] = $orderedFilters['0'] ?? [];
            if (isset($orderedFilters['0'])) {
                unset($orderedFilters['0']);
            }
        }
        ksort($orderedFilters);

        return $orderedFilters;
    }
}
