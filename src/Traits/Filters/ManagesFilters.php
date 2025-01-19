<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait ManagesFilters
{
    /**
     * Sets Filter Default Values
     */
    public function mountManagesFilters(): void
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

    public function bootedManagesFilters(): void
    {
        $this->setBuilder($this->builder());

        foreach ($this->filterComponents as $filterKey => $value) {
            $this->appliedFilters[$filterKey] = $value;
        }
    }
}
