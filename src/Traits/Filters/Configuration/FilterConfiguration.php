<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Filters\Configuration;

use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\On;
use Rappasoft\LaravelLivewireTables\Events\FilterApplied;
use Rappasoft\LaravelLivewireTables\Views\Filter;
use Rappasoft\LaravelLivewireTables\Views\Filters\{BooleanFilter,MultiSelectDropdownFilter, MultiSelectFilter};

trait FilterConfiguration
{
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

    public function applyFilters(): Builder
    {
        if ($this->filtersAreEnabled() && $this->hasFilters() && $this->hasAppliedFiltersWithValues()) {
            foreach ($this->getFilters() as $filter) {
                foreach ($this->getAppliedFiltersWithValues() as $key => $value) {
                    if ($filter->getKey() === $key && $filter->hasFilterCallback()) {
                        // Let the filter class validate the value
                        $value = $filter->validate($value);
                        if (! ($filter instanceof BooleanFilter) && ($value === false)) {
                            continue;
                        }

                        $this->callHook('filterApplying', ['filter' => $filter->getKey(), 'value' => $value]);
                        $this->callTraitHook('filterApplying', ['filter' => $filter->getKey(), 'value' => $value]);

                        ($filter->getFilterCallback())($this->getBuilder(), $value);
                    }
                }
            }
            $this->storeFilterValues();
        }

        return $this->getBuilder();
    }

    public function updatedFilterComponents(string|array|null $value, string $filterName): void
    {
        $this->resetComputedPage();

        // Clear bulk actions on filter - if enabled
        if ($this->getClearSelectedOnFilter()) {
            $this->clearSelected();
            $this->setSelectAllDisabled();
        }

        // Clear filters on empty value
        $filter = $this->getFilterByKey($filterName);

        if ($filter && $filter->isEmpty($value)) {
            $this->callHook('filterRemoved', ['filter' => $filter->getKey()]);
            $this->callTraitHook('filterRemoved', ['filter' => $filter->getKey()]);

            $this->resetFilter($filterName);
        } elseif ($filter) {
            $this->callHook('filterUpdated', ['filter' => $filter->getKey(), 'value' => $value]);
            $this->callTraitHook('filterUpdated', ['filter' => $filter->getKey(), 'value' => $value]);
            if ($this->getEventStatusFilterApplied() && $filter->getKey() != null && $value != null) {
                event(new FilterApplied($this->getTableName(), $filter->getKey(), $value));
            }
            $this->dispatch('filter-was-set', tableName: $this->getTableName(), filterKey: $filter->getKey(), value: $value);

        }

    }
}
