<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Livewire\Attributes\Locked;
use Rappasoft\LaravelLivewireTables\Events\FilterApplied;
use Rappasoft\LaravelLivewireTables\Traits\Configuration\FilterConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Helpers\FilterHelpers;

trait WithFilters
{
    use FilterConfiguration,
        FilterHelpers;

    #[Locked]
    public bool $filtersStatus = true;

    #[Locked]
    public bool $filtersVisibilityStatus = true;

    #[Locked]
    public bool $filterPillsStatus = true;

    // Entangled in JS
    public bool $filterSlideDownDefaultVisible = false;

    #[Locked]
    public string $filterLayout = 'popover';

    #[Locked]
    public int $filterCount;

    // Set in JS
    public array $filterComponents = [];

    // Set in Frontend
    public array $appliedFilters = [];

    public array $filterGenericData = [];

    protected ?Collection $filterCollection;

    public function filters(): array
    {
        return [];
    }

    protected function queryStringWithFilters(): array
    {
        if ($this->queryStringIsEnabled() && $this->filtersAreEnabled()) {
            return [
                'appliedFilters' => ['except' => null, 'history' => false, 'keep' => false, 'as' => $this->getQueryStringAlias().'-filters'],
            ];
        }

        return [];
    }

    public function applyFilters(): Builder
    {
        if ($this->filtersAreEnabled() && $this->hasFilters() && $this->hasAppliedFiltersWithValues()) {
            foreach ($this->getFilters() as $filter) {
                foreach ($this->getAppliedFiltersWithValues() as $key => $value) {
                    if ($filter->getKey() === $key && $filter->hasFilterCallback()) {
                        // Let the filter class validate the value
                        $value = $filter->validate($value);

                        if ($value === false) {
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
