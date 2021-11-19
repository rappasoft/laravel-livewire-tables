<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use DateTime;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Schema;
use Rappasoft\LaravelLivewireTables\Utilities\ColumnUtilities;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;

/**
 * Trait WithFilters.
 */
trait WithFilters
{

    /**
     * @var bool
     */
    public bool $filtersEnabled = true;

    /**
     * Filter values
     *
     * @var array
     */
    public array $filters = [];

    /**
     * Map filter names
     *
     * @var array
     */
    public array $filterNames = [];

    /**
     * Show the filter pills
     *
     * @var bool
     */
    public bool $showFilters = true;

    /**
     * Show the filter dropdown
     *
     * @var bool
     */
    public bool $showFilterDropdown = true;

    /**
     * Default filters
     *
     * @var array|null[]
     */
    public array $baseFilters = [
        'search' => null,
    ];

    /**
     * Prebuild the $filters array
     */
    public function mountWithFilters(): void
    {
        if (! $this->filtersEnabled) {
            return;
        }

        $this->checkFilters();
    }

    /**
     * Reset the filters array but keep the value for search
     */
    public function resetFilters(): void
    {
        $search = $this->filters['search'] ?? null;

        $this->reset('filters');

        $this->filters['search'] = $search;

        $this->checkFilters();
    }

    /**
     * Runs when any filter is changed
     */
    public function updatedFilters(): void
    {
        // Remove the search filter when it's empty
        if (isset($this->filters['search']) && $this->filters['search'] === '') {
            $this->resetSearch();
        }

        // Remove any url params that are empty
        $this->checkFilters();

        // Reset the page when filters are changed
        $this->resetPage();
    }

    /**
     * Define the filters array
     *
     * @return Filter[]
     */
    public function filters(): array
    {
        return [];
    }

    /**
     * Removes any filters that are empty
     */
    public function checkFilters(): void
    {
        foreach ($this->filters() as $key => $filter) {
            if (isset($this->filters[$key]) && filled($this->filters[$key])) {
                continue;
            }

            // If the filter is multiselect, we'll initialize it as an array.
            if ($filter->isMultiSelect()) {
                $this->filters[$key] = [];

                continue;
            }

            $this->filters[$key] = null;
        }
    }

    /**
     * Cleans $filter property of any values that don't exist
     * in the filter() definition.
     */
    public function cleanFilters(): void
    {
        // Filter $filters values
        $this->filters = collect($this->filters)->filter(function ($filterValue, $filterName) {
            $filterDefinitions = $this->filters();

            // Ignore search
            if ($filterName === 'search') {
                return true;
            }

            // Filter out any keys that weren't defined as a filter
            if (! isset($filterDefinitions[$filterName])) {
                return false;
            }

            // Ignore null values
            if (is_null($filterValue)) {
                return true;
            }

            // Handle 'select' filters
            if ($filterDefinitions[$filterName]->isSelect()) {
                foreach ($this->getFilterOptions($filterName) as $optionValue) {
                    // If the option is an integer, typecast filter value
                    if (is_int($optionValue) && $optionValue === (int)$filterValue) {
                        return true;
                    }

                    // Strict check the value
                    if ($optionValue === $filterValue) {
                        return true;
                    }
                }
            }

            // Handle 'multiselect' filters
            if ($filterDefinitions[$filterName]->isMultiSelect() && is_array($filterValue)) {
                foreach ($filterValue as $selectedValue) {
                    if (! in_array($selectedValue, $this->getFilterOptions($filterName))) {
                        return false;
                    }
                }

                return true;
            }

            if ($filterDefinitions[$filterName]->isDate()) {
                // array_sum trick is a terse way of ensuring that PHP
                // did not do "month shifting"
                // (e.g. consider that January 32 is February 1)
                $dt = DateTime::createFromFormat("Y-m-d", $filterValue);

                return $dt !== false && ! array_sum($dt::getLastErrors());
            }

            return false;
        })->toArray();
    }

    public function selectAllFilters($filterKey): void
    {
        $filter = $this->filters()[$filterKey];

        if (! $filter->isMultiSelect()) {
            return;
        }

        if (count($this->filters[$filterKey]) === count($filter->options())) {
            $this->removeFilter($filterKey);

            return;
        }

        $this->filters[$filterKey] = array_keys($filter->options());
    }

    /**
     * Define the string location to a view to be included as the filters view
     *
     * @return string|null
     */
    public function filtersView(): ?string
    {
        return null;
    }

    /**
     * Check if a filter exists and isn't null
     *
     * @param  string  $filter
     *
     * @return bool
     */
    public function hasFilter(string $filter): bool
    {
        return isset($this->filters[$filter]) && $this->filters[$filter] !== null && $this->filters[$filter] !== '';
    }

    /**
     * Get the value of a given filter
     *
     * @param  string  $filter
     *
     * @return int|string|null
     */
    public function getFilter(string $filter)
    {
        if ($this->hasFilter($filter)) {
            if (in_array($filter, collect($this->filters())->keys()->toArray(), true) && $this->filters()[$filter]->isSelect()) {
                return $this->hasIntegerKeys($filter) ? (int)$this->filters[$filter] : trim($this->filters[$filter]);
            }

            if (is_string($this->filters[$filter])) {
                return trim($this->filters[$filter]);
            }

            return $this->filters[$filter];
        }

        return null;
    }

    /**
     * @return array
     */
    public function getFilters(): array
    {
        return collect($this->filters)
            ->reject(fn ($value) => blank($value))
            ->toArray();
    }

    /**
     * @return array
     */
    public function getFiltersWithoutSearch(): array
    {
        return collect($this->getFilters())
            ->reject(fn ($_value, $key) => $key === 'search')
            ->toArray();
    }

    /**
     * Set a given filter to null
     *
     * @param $filter
     */
    public function removeFilter($filter): void
    {
        if (! isset($this->filters[$filter])) {
            return;
        }

        if ($filter === 'search') {
            $this->filters['search'] = null;

            return;
        }

        if ($this->filters()[$filter]->isMultiSelect()) {
            $this->filters[$filter] = [];

            return;
        }

        $this->filters[$filter] = null;
    }

    /**
     * Get the options for a given filter if they exist
     *
     * @param  string  $filter
     *
     * @return array
     */
    public function getFilterOptions(string $filter): array
    {
        return collect($this->filters()[$filter]->options())
            ->keys()
            ->reject(fn ($item) => $item === '' || $item === null)
            ->values()
            ->toArray();
    }

    /**
     * Check whether the filter has numeric keys or not
     *
     * @param  string  $filter
     *
     * @return bool
     */
    public function hasIntegerKeys(string $filter): bool
    {
        return is_int($this->getFilterOptions($filter)[0] ?? null);
    }

    /**
     * Collects columns with $searchable = true
     *
     * @return Column[]
     */
    public function getSearchableColumns() : array
    {
        return array_filter($this->columns(), fn (Column $column) => $column->isSearchable());
    }

    /**
     * Apply Search Filter
     *
     * @param Builder|Relation $query
     * @return Builder|Relation
     */
    public function applySearchFilter($query)
    {
        $searchableColumns = $this->getSearchableColumns();

        if ($this->hasFilter('search') && count($searchableColumns)) {
            $search = $this->getFilter('search');

            // Group search conditions together
            $query->where(function (Builder $subQuery) use ($search, $query, $searchableColumns) {
                foreach ($searchableColumns as $column) {
                    // Does this column have an alias or relation?
                    $hasRelation = ColumnUtilities::hasRelation($column->column());

                    // Let's try to map this column to a selected column
                    $selectedColumn = ColumnUtilities::mapToSelected($column->column(), $query);

                    // If the column has a search callback, just use that
                    if ($column->hasSearchCallback()) {
                        // Call the callback
                        ($column->getSearchCallback())($subQuery, $search);
                    } elseif (! $hasRelation || $selectedColumn) { // If the column isn't a relation or if it was previously selected
                        $whereColumn = $selectedColumn ?? $column->column();

                        // TODO: Skip Aggregates
                        if (! $hasRelation) {
                            $whereColumn = Schema::hasColumn($query->getModel()->getTable(), $whereColumn) ? $query->getModel()->getTable() . '.' . $whereColumn : $whereColumn;
                        }

                        // We can use a simple where clause
                        $subQuery->orWhere($whereColumn, 'like', '%' . $search . '%');
                    } else {
                        // Parse the column
                        $relationName = ColumnUtilities::parseRelation($column->column());
                        $fieldName = ColumnUtilities::parseField($column->column());

                        // We use whereHas which can work with unselected relations
                        $subQuery->orWhereHas($relationName, function (Builder $hasQuery) use ($fieldName, $search) {
                            $hasQuery->where($fieldName, 'like', '%' . $search . '%');
                        });
                    }
                }
            });
        }

        return $query;
    }
}
