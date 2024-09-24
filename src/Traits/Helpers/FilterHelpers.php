<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Helpers;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Rappasoft\LaravelLivewireTables\Events\FilterApplied;
use Rappasoft\LaravelLivewireTables\Views\Filter;
use Rappasoft\LaravelLivewireTables\Views\Filters\MultiSelectDropdownFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\MultiSelectFilter;

trait FilterHelpers
{
    /**
     * Sets Filter Default Values
     */
    public function mountFilterHelpers(): void
    {
        $this->restoreFilterValues();

        foreach ($this->getFilters() as $filter) {
            if (! isset($this->appliedFilters[$filter->getKey()])) {
                if ($filter->hasFilterDefaultValue()) {
                    $this->setFilter($filter->getKey(), $filter->getFilterDefaultValue());
                } else {
                    $this->resetFilter($filter);
                }
            } else {
                $this->setFilter($filter->getKey(), $this->appliedFilters[$filter->getKey()]);
            }
        }
    }

    public function getFiltersStatus(): bool
    {
        return $this->filtersStatus;
    }

    public function filtersAreEnabled(): bool
    {
        return $this->getFiltersStatus() === true;
    }

    public function filtersAreDisabled(): bool
    {
        return $this->getFiltersStatus() === false;
    }

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

    public function getFilterSlideDownDefaultStatus(): bool
    {
        return $this->filterSlideDownDefaultVisible;
    }

    public function filtersSlideDownIsDefaultVisible(): bool
    {
        return $this->getFilterSlideDownDefaultStatus() === true;
    }

    public function filtersSlideDownIsDefaultHidden(): bool
    {
        return $this->getFilterSlideDownDefaultStatus() === false;
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

    public function hasFilters(): bool
    {
        return $this->getFiltersCount() > 0;
    }

    public function hasVisibleFilters(): bool
    {
        return $this->getFilters()
            ->reject(fn (Filter $filter) => $filter->isHiddenFromMenus())
            ->count() > 0;
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
    public function getAppliedFiltersWithValues(): array
    {
        return $this->appliedFilters = array_filter($this->getAppliedFilters(), function ($item, $key) {
            return ! $this->getFilterByKey($key)->isEmpty($item) && (is_array($item) ? count($item) : $item !== null);
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

    public function getFilterLayout(): string
    {
        return $this->filterLayout;
    }

    public function isFilterLayoutPopover(): bool
    {
        return $this->getFilterLayout() === 'popover';
    }

    public function isFilterLayoutSlideDown(): bool
    {
        return $this->getFilterLayout() === 'slide-down';
    }

    /**
     * Get whether any filter has a configured slide down row.
     */
    public function hasFiltersWithSlidedownRows(): bool
    {
        return $this->getFilters()
            ->reject(fn (Filter $filter) => ! $filter->hasFilterSlidedownRow())
            ->count() > 0;
    }

    /**
     * Get whether filter has a configured slide down row.
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

    public function hasFilterGenericData(): bool
    {
        return ! empty($this->filterGenericData);
    }

    #[Computed]
    public function getFilterGenericData(): array
    {
        if (! $this->hasFilterGenericData()) {
            $this->setFilterGenericData($this->generateFilterGenericData());
        }

        return $this->filterGenericData;
    }

    #[Computed]
    public function showFilterPillsSection(): bool
    {
        return $this->filtersAreEnabled() && $this->filterPillsAreEnabled() && $this->hasAppliedVisibleFiltersForPills();
    }
}
