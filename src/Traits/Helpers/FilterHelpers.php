<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Helpers;

use Illuminate\Support\Collection;
use Rappasoft\LaravelLivewireTables\Views\Filter;
use Rappasoft\LaravelLivewireTables\Views\Filters\MultiSelectFilter;

trait FilterHelpers
{
    /**
     * @param string $column
     * @param string $value
     * @return array
     */
    public function getFiltersStatus(): bool
    {
        return $this->filtersStatus;
    }

    /**
     * @param string $column
     * @param string $value
     * @return array
     */
    public function filtersAreEnabled(): bool
    {
        return $this->getFiltersStatus() === true;
    }

    /**
     * @param string $column
     * @param string $value
     * @return array
     */
    public function filtersAreDisabled(): bool
    {
        return $this->getFiltersStatus() === false;
    }

    /**
     * @param string $column
     * @param string $value
     * @return array
     */
    public function getFiltersVisibilityStatus(): bool
    {
        return $this->filtersVisibilityStatus;
    }

    /**
     * @param string $column
     * @param string $value
     * @return array
     */
    public function filtersVisibilityIsEnabled(): bool
    {
        return $this->getFiltersVisibilityStatus() === true;
    }

    /**
     * @param string $column
     * @param string $value
     * @return array
     */
    public function filtersVisibilityIsDisabled(): bool
    {
        return $this->getFiltersVisibilityStatus() === false;
    }

    /**
     * @param string $column
     * @param string $value
     * @return array
     */
    public function getFilterPillsStatus(): bool
    {
        return $this->filterPillsStatus;
    }

    /**
     * @param string $column
     * @param string $value
     * @return array
     */
    public function filterPillsAreEnabled(): bool
    {
        return $this->getFilterPillsStatus() === true;
    }

    /**
     * @param string $column
     * @param string $value
     * @return array
     */
    public function filterPillsAreDisabled(): bool
    {
        return $this->getFilterPillsStatus() === false;
    }

    /**
     * @param string $column
     * @param string $value
     * @return array
     */
    public function hasFilters(): bool
    {
        return $this->getFilters()->count();
    }

    /**
     * @param string $column
     * @param string $value
     * @return array
     */
    public function getFilters(): Collection
    {
        return collect($this->filters());
    }

    /**
     * @param string $column
     * @param string $value
     * @return array
     */
    public function getFiltersCount(): int
    {
        return $this->getFilters()->count();
    }

    /**
     * @param string $column
     * @param string $value
     * @return array
     */
    public function getFilterByKey(string $key)
    {
        return $this->getFilters()->first(function ($filter) use ($key) {
            return $filter->getKey() === $key;
        });
    }

    /**
     * @param string $column
     * @param string $value
     * @return array
     */
    public function setFilter(string $filterKey, $value)
    {
        return $this->{$this->getTableName()}['filters'][$filterKey] = $value;
    }

    /**
     * @param string $column
     * @param string $value
     * @return array
     */
    public function selectAllFilterOptions(string $filterKey): void
    {
        $filter = $this->getFilterByKey($filterKey);

        if (! $filter instanceof MultiSelectFilter) {
            return;
        }

        if (count($this->getAppliedFilterWithValue($filterKey) ?? []) === count($filter->getOptions())) {
            $this->resetFilter($filterKey);

            return;
        }

        $this->setFilter($filterKey, array_keys($filter->getOptions()));
    }

    /**
     * @param string $column
     * @param string $value
     * @return array
     */
    public function setFilterDefaults(): void
    {
        foreach ($this->getFilters() as $filter) {
            $this->resetFilter($filter);
        }
    }

    /**
     * @param string $column
     * @param string $value
     * @return array
     */
    public function getAppliedFilters(): array
    {
        return $this->{$this->getTableName()}['filters'] ?? [];
    }

    /**
     * @param string $column
     * @param string $value
     * @return array
     */
    public function hasAppliedFiltersWithValues(): bool
    {
        return count($this->getAppliedFiltersWithValues());
    }

    /**
     * @param string $column
     * @param string $value
     * @return array
     */
    public function getAppliedFiltersWithValues(): array
    {
        return array_filter($this->getAppliedFilters(), function ($item) {
            return is_array($item) ? count($item) : $item !== null;
        });
    }

    /**
     * @param string $column
     * @param string $value
     * @return array
     */
    public function getAppliedFilterWithValue(string $filterKey)
    {
        return $this->getAppliedFiltersWithValues()[$filterKey] ?? null;
    }

    /**
     * @param string $column
     * @param string $value
     * @return array
     */
    public function getAppliedFiltersWithValuesCount(): int
    {
        return count($this->getAppliedFiltersWithValues());
    }

    /**
     * @param string $column
     * @param string $value
     * @return array
     */
    public function resetFilter($filter): void
    {
        if (! $filter instanceof Filter) {
            $filter = $this->getFilterByKey($filter);
        }
        
        $this->setFilter($filter->getKey(), $filter->getDefaultValue());
    }

    /**
     * @param string $column
     * @param string $value
     * @return array
     */
    public function getFilterLayout(): string
    {
        return $this->filterLayout;
    }

    /**
     * @param string $column
     * @param string $value
     * @return array
     */
    public function isFilterLayoutPopover(): bool
    {
        return $this->getFilterLayout() === 'popover';
    }

    /**
     * @param string $column
     * @param string $value
     * @return array
     */
    public function isFilterLayoutSlideDown(): bool
    {
        return $this->getFilterLayout() === 'slide-down';
    }
}
