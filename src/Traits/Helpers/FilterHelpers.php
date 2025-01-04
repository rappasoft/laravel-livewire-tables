<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Helpers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Livewire\Attributes\{Computed,On};
use Rappasoft\LaravelLivewireTables\Events\FilterApplied;
use Rappasoft\LaravelLivewireTables\Views\Filter;
use Rappasoft\LaravelLivewireTables\Views\Filters\{MultiSelectDropdownFilter, MultiSelectFilter};

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

    #[On('setFilter')]
    #[On('set-filter')]
    public function setFilter(string $filterKey, string|array|null $value): void
    {
        $this->appliedFilters[$filterKey] = $this->filterComponents[$filterKey] = $value;

        $this->callHook('filterSet', ['filter' => $filterKey, 'value' => $value]);
        $this->callTraitHook('filterSet', ['filter' => $filterKey, 'value' => $value]);
        if ($this->getEventStatusFilterApplied() && $filterKey != null && $value != null) {
            event(new FilterApplied($this->getTableName(), $filterKey, $value));
        }
        $this->dispatch('filter-was-set', tableName: $this->getTableName(), filterKey: $filterKey, value: $value);
        $this->storeFilterValues();

    }

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

    #[On('clearFilters')]
    #[On('clear-filters')]
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

    /**
     * @param  mixed  $filter
     */
    public function resetFilter($filter): void
    {
        if (! $filter instanceof Filter) {
            $filter = $this->getFilterByKey($filter);
        }
        $this->callHook('filterReset', ['filter' => $filter->getKey()]);
        $this->callTraitHook('filterReset', ['filter' => $filter->getKey()]);
        $this->setFilter($filter->getKey(), $filter->getDefaultValue());

    }

    #[On('livewireArrayFilterUpdateValues')]
    public function updateLivewireArrayFilterValues(string $filterKey, string $tableName, array $values): void
    {
        if ($this->tableName == $tableName) {
            $filter = $this->getFilterByKey($filterKey);
            $filter->options($values);
        }

    }
}
