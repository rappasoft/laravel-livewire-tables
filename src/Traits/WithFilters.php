<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Utilities\ColumnUtilities;
use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Trait WithFilters.
 */
trait WithFilters
{
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
        foreach ($this->filters() as $filter => $_default) {
            if (! isset($this->filters[$filter])) {
                $this->filters[$filter] = null;
            }
        }
    }

    /**
     * Reset the filters array but keep the value for search
     */
    public function resetFilters(): void
    {
        $search = $this->filters['search'] ?? null;

        $this->reset('filters');

        $this->filters['search'] = $search;
    }

    /**
     * Reset the page if the filters are updated
     */
    public function updatingFilters(): void
    {
        $this->resetPage();
    }

    /**
     * Reset all the filters
     */
    public function resetAll(): void
    {
        $this->resetFilters();
        $this->resetSorts();
        $this->resetBulk();
    }

    /**
     * Define the filters array
     *
     * @return array
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

            return false;
        })->toArray();
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
        return isset($this->filters[$filter]) && $this->filters[$filter] !== null;
    }

    /**
     * Get the value of a given filter
     *
     * @param  string  $filter
     *
     * @return string|null
     */
    public function getFilter(string $filter): ?string
    {
        return $this->filters[$filter] ?? null;
    }

    /**
     * Set a given filter to null
     *
     * @param $filter
     */
    public function removeFilter($filter): void
    {
        if (isset($this->filters[$filter])) {
            $this->filters[$filter] = null;
        }
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
        return array_filter(array_keys($this->filters()[$filter]->options() ?? []));
    }

    /**
     * Collects columns with $searchable = true
     *
     * @return Column[]
     */
    public function getSearchableColumns() : array
    {
        return array_filter($this->columns(), function(Column $column) {
            return $column->isSearchable();
        });
    }

    /**
     * Apply Search Filter
     *
     * @param Builder $query
     * @return Builder
     */
    public function applySearchFilter(Builder $query): Builder
    {
        if ($this->hasFilter('search')) {

            // get search value
            $search = $this->getFilter('search');

            // trim
            $search = trim($search);

            // group search conditions together
            $query->where(function (Builder $subQuery) use ($search, $query) {

                foreach ($this->getSearchableColumns() as $column) {

                    // does this column have an alias or relation?
                    $hasRelation = ColumnUtilities::hasRelation($column->column());

                    // let's try to map this column to a selected column
                    $selectedColumn = ColumnUtilities::mapToSelected($column->column(), $query);

                    // if the column has a search callback, just use that
                    if ($column->searchCallback) {

                        // call the callback
                        ($column->searchCallback)($query, $search);

                    // if the column isn't a relation or if it was previously selected
                    } elseif (! $hasRelation || $selectedColumn) {

                        $whereColumn = $selectedColumn ?? $column->column();

                        // @todo: skip aggregates
                        if (!$hasRelation && $query instanceof Builder) {
                            $whereColumn = $query->getModel()->getTable() . '.' . $whereColumn;
                        }

                        // we can use a simple where clause
                        $subQuery->orWhere($whereColumn, 'like', '%' . $search . '%');

                    } else {

                        // parse the column
                        $relationName = ColumnUtilities::parseRelation($column->column());
                        $fieldName = ColumnUtilities::parseField($column->column());

                        // we use whereHas which can work with unselected relations
                        $subQuery->orWhereHas($relationName, function (Builder $hasQuery) use ($fieldName, $column, $search) {
                            $hasQuery->where($fieldName, 'like', '%' . $search . '%');
                        });

                    }
                }
            });

        }

        return $query;
    }
}
