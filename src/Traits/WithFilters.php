<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Traits\Configuration\FilterConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Helpers\FilterHelpers;

trait WithFilters
{
    use FilterConfiguration,
        FilterHelpers;

    public bool $filtersStatus = true;
    public bool $filtersVisibilityStatus = true;
    public bool $filterPillsStatus = true;
    public string $filterLayout = 'popover';

    // Set the filter defaults based on the filter type
    public function mountWithFilters(): void
    {
        $this->setFilterDefaults();
    }

    public function filters(): array
    {
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

                        ($filter->getFilterCallback())($this->getBuilder(), $value);
                    }
                }
            }
        }

        return $this->getBuilder();
    }
}
