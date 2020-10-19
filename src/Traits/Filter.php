<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Rappasoft\LaravelLivewireTables\Filters\BaseFilter;

trait Filter
{
    /**
     * Current query string with the filters value.
     *
     * @var array
     */
    public $filters = [];

    /**
     * All filters customized in the child class.
     *
     * @var BaseFilter[]
     */
    public $filtersViews;

    /**
     * Whether or not filtering is enabled.
     *
     * @var bool
     */
    public $filterEnabled = true;

    /**
     * A button to clear the filters.
     *
     * @var bool
     */
    public $clearFilterButton = true;

    /**
     * Class to apply to the clear button.
     *
     * @var string
     */
    public $clearFilterButtonClass = 'btn btn-outline-dark';

    public function hydrateFilter()
    {
        $this->filtersViews = $this->filtersViews();
        $this->cleanFilters();
    }

    public function mountFilter()
    {
        $this->filtersViews = $this->filtersViews();
        $this->filters = $this->getFilterValues($this->filters);
        $this->cleanFilters();
    }

    /**
     * Returns the selected filters views
     */
    public function filtersViews(): array
    {
        return [];
    }

    /**
     * Resets the filters.
     */
    public function clearFilters(): void
    {
        $this->reset('filters');
    }

    /**
     * Remove empty or falsy values from filters.
     */
    public function cleanFilters(): void
    {
        foreach ($this->filters as $filter => $value) {
            if (is_array($value)) {
                $this->filters[$filter] = array_filter($value, fn ($item) => $item);

                if (empty($this->filters[$filter])) {
                    unset($this->filters[$filter]);
                }
            }

            if ($value === null || $value === '') {
                unset($this->filters[$filter]);
            }
        }
    }

    /**
     * Returns the filters array ready to be used with models filters.
     */
    public function normalizedFilters(): array
    {
        $this->cleanFilters();

        $filters = $this->getFilterValues($this->filters);

        foreach ($filters as $filter => $value) {
            if (is_array($value)) {
                $filters[$filter] = array_keys($value);
            }
        }

        return $filters;
    }

    /**
     * Casts all boolean values of the querystring from string to boolean
     * this is needed to set the boolean filter values properly.
     *
     * @param $currentValue
     * @return array
     */
    public function getFilterValues($currentValue): array
    {
        $filters = request()->query('filters', $currentValue);

        return collect($filters)->map(function ($filter) {
            /** If is an array that means it came from a boolean filter */
            if (is_array($filter)) {
                foreach ($filter as $option => $checked) {
                    /** Casts from string to boolean */
                    $filter[$option] = filter_var($checked, FILTER_VALIDATE_BOOLEAN);
                }
            }

            return $filter;
        })->toArray();
    }
}
