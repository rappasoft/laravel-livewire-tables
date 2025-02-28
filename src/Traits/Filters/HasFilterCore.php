<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Traits\Filters\Configuration\FilterConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Filters\Helpers\FilterHelpers;

trait HasFilterCore
{
    use FilterConfiguration,
        FilterHelpers;

    /**
     * Sets Filter Default Values
     */
    public function mountHasFilterCore(): void
    {
        $this->restoreFilterValues();

        foreach ($this->getFilters() as $filter) {
            if (method_exists($filter, 'isAnExternalLivewireFilter')) {
                $this->tableHasExternalFilters = true;
            }
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

    public function bootedHasFilterCore(): void
    {
        $this->setBuilder($this->builder());

        foreach ($this->filterComponents as $filterKey => $value) {
            $this->appliedFilters[$filterKey] = $value;
        }
    }
}
