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
    public array $filters = [];
    public array $filterNames = [];
    public array $baseFilters = [
        'search' => null,
    ];

    public function resetFilters(): void
    {
        // save the search filter
        $search = $this->filters['search'] ?? null;
        // clear filters
        $this->reset('filters');
        // re-add the search filter
        $this->filters['search'] = $search;
    }

    public function resetAll(): void
    {
        $this->resetFilters();
        $this->resetSorts();
        $this->resetBulk();
    }

    public function filters(): array
    {
        return [];
    }

    public function cleanFilters(): void
    {
        foreach ($this->filters() as $key => $filter) {
            if (
                $filter->isSelect() &&
                $this->hasFilter($key) &&
                ! in_array($this->getFilter($key), $this->getFilterOptions($key), true)
            ) {
                $this->removeFilter($key);
            }
        }
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

    /**
     * Apply Filters
     *
     * @param Builder $query
     * @return Builder
     */
    public function applyFilters(Builder $query): Builder
    {
        foreach ($this->filters() as $key => $filter) {

            // @todo: do the things

        }

        return $query;
    }

    /**
     * Apply Search Filter
     *
     * @param Builder $query
     * @return Builder
     */
    public function applySearchFilter(Builder $query): Builder
    {
        // @todo: make truthy?
        if ($this->hasFilter('search')) {

            $search = $this->getFilter('search');

            // trim?
            $search = trim($search);

            // group search conditions together
            $query->where(function (Builder $subQuery) use ($search, $query) {

                foreach ($this->columns() as $column) {

                    // only apply to searchable columns
                    if ($column->isSearchable()) {

                        // does this column have a relation?
                        $hasRelation = ColumnUtilities::hasRelation($column->column());

                        // let's try to map this column to a selected column
                        $selectedColumn = ColumnUtilities::mapToSelected($column->column(), $query);

                        //var_dump($selectedColumn);

                        // if the column isn't a relation or if it was previously selected
                        if (!$hasRelation || $selectedColumn) {

                            switch ($column->type) {
                                case Column::TYPE_BOOLEAN:
                                    $subQuery->orWhere($selectedColumn ?? $column->column(), '=', (bool)$search);
                                    break;
                                case Column::TYPE_NUMBER:
                                    $subQuery->orWhere($selectedColumn ?? $column->column(), '=', $search);
                                    break;
                                default:
                                    $subQuery->orWhere($selectedColumn ?? $column->column(), 'like', '%' . $search . '%');
                            }

                        } else {

                            $relationName = ColumnUtilities::parseRelation($column->column());
                            $fieldName = ColumnUtilities::parseField($column->column());

                            $subQuery->orWhereHas($relationName, function (Builder $hasQuery) use ($fieldName, $column, $search) {

                                switch ($column->type) {
                                    case Column::TYPE_BOOLEAN:
                                        $hasQuery->where($fieldName, '=', (bool)$search);
                                        break;
                                    case Column::TYPE_NUMBER:
                                        $hasQuery->where($fieldName, '=', $search);
                                        break;
                                    default:
                                        $hasQuery->where($fieldName, 'like', '%' . $search . '%');
                                }

                            });


                        }

                    }
                }

            });

        }

        return $query;
    }
}
