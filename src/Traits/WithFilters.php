<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Rappasoft\LaravelLivewireTables\Views\Filter;

/**
 * Trait WithFilters.
 */
trait WithFilters
{
    public array $filters = [];
    public array $filterNames = [];
    public array $baseFilters = [
        'search' => null,
    ];

    public function mountWithFilters()
    {
        foreach ($this->filters() as $filter => $options) {
            if (! isset($this->filters[$filter])) {
                $this->filters[$filter] = null;
            }
        }
    }

    public function resetFilters(): void
    {
        $search = $this->filters['search'] ?? null;
        $this->reset('filters');
        $this->filters['search'] = $search;
    }

    public function updatingFilters(): void
    {
        $this->resetPage();
    }

    public function resetAll(): void
    {
        $this->resetFilters();
        $this->resetSorts();
        $this->resetBulk();
    }

    /**
     * Define filters
     *
     * @return Filter[]
     */
    public function filters(): array
    {
        return [];
    }

    /**
     * Cleans $filter property of any values that don't exist
     * in the filter() definition.
     */
    public function cleanFilters(): void
    {
        // grab the filter definitions
        $filterDefinitions = $this->filters();

        // filter $filters values
        $this->filters = array_filter($this->filters, function($filterValue, $filterName) use($filterDefinitions) {

            // ignore search
            if ($filterName === 'search') {
                return true;
            }

            // filter out any keys that weren't defined as a filter
            if (!isset($filterDefinitions[$filterName])) {
                return false;
            }

            // ignore null values
            if (is_null($filterValue)) {
                return true;
            }

            // handle Select filters
            if ($filterDefinitions[$filterName]->isSelect()) {

                foreach ($filterDefinitions[$filterName]->options() as $optionValue => $optionLabel) {

                    // if the option is an integer, typecast filter value
                    if (is_int($optionValue) && $optionValue === (int)$filterValue) {
                        return true;
                    // strict check the value
                    } elseif ($optionValue === $filterValue) {
                        return true;
                    }

                }

            }

            return false;

        }, ARRAY_FILTER_USE_BOTH);
    }

    public function filtersView(): ?string
    {
        return null;
    }

    public function hasFilter(string $filter): bool
    {
        return isset($this->filters[$filter]) && $this->filters[$filter] !== null;
    }

    public function getFilter(string $filter): ?string
    {
        return $this->filters[$filter] ?? null;
    }

    public function removeFilter($filter): void
    {
        if (isset($this->filters[$filter])) {
            $this->filters[$filter] = null;
        }
    }

    public function getFilterOptions(string $filter): array
    {
        return array_filter(array_keys($this->filters()[$filter]->options() ?? []));
    }
}
