<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Pagination\CursorPaginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Views\Column;

trait WithData
{
    /**
     * Sets up the Builder instance
     */
    public function bootedWithData(): void
    {
        //Sets up the Builder Instance
        $this->setBuilder($this->builder());
    }

    /**
     * Retrieves the rows for the executed query
     */
    public function getRows(): Collection|CursorPaginator|Paginator|LengthAwarePaginator
    {
        // Setup the Base Query
        $this->baseQuery();

        // Execute the Query
        $executedQuery = $this->executeQuery();

        // Get All Currently Paginated Items Primary Keys
        $this->paginationCurrentItems = $executedQuery->pluck($this->getPrimaryKey())->toArray() ?? [];

        // Get Count of Items in Current Page
        $this->paginationCurrentCount = $executedQuery->count();

        // Fire hook for rowsRetrieved
        $this->callHook('rowsRetrieved', [$executedQuery]);
        $this->callTraitHook('rowsRetrieved', [$executedQuery]);

        return $executedQuery;
    }

    protected function baseQuery(): Builder
    {
        $this->setBuilder($this->joinRelations());

        $this->setBuilder($this->applySearch());

        $this->setBuilder($this->applyFilters());

        return $this->getBuilder();

    }

    protected function executeQuery(): Collection|CursorPaginator|Paginator|LengthAwarePaginator
    {
        // Moved these from baseQuery to here to avoid pulling all fields when cloning baseQuery.
        $this->setBuilder($this->selectFields());

        if ($this->currentlyReorderingIsEnabled()) {
            $this->setBuilder($this->getBuilder()->orderBy($this->getDefaultReorderColumn(), $this->getDefaultReorderDirection()));
        } else {
            $this->applySorting();

        }

        if ($this->paginationIsEnabled()) {
            if ($this->isPaginationMethod('standard')) {
                $paginatedResults = $this->getBuilder()->paginate($this->getPerPage() === -1 ? $this->getBuilder()->count() : $this->getPerPage(), ['*'], $this->getComputedPageName());

                // Get the total number of items available
                $this->paginationTotalItemCount = $paginatedResults->total() ?? 0;

                return $paginatedResults;
            }

            if ($this->isPaginationMethod('simple')) {

                $this->paginationTotalItemCount = $this->getBuilder()->count();

                return $this->getBuilder()->simplePaginate($this->getPerPage() === -1 ? $this->paginationTotalItemCount : $this->getPerPage(), ['*'], $this->getComputedPageName());

            }

            if ($this->isPaginationMethod('cursor')) {

                $this->paginationTotalItemCount = $this->getBuilder()->count();

                return $this->getBuilder()->cursorPaginate($this->getPerPage() === -1 ? $this->paginationTotalItemCount : $this->getPerPage(), ['*'], $this->getComputedPageName());
            }
        }

        return $this->getBuilder()->get();
    }

    protected function joinRelations(): Builder
    {
        if ($this->getExcludeDeselectedColumnsFromQuery()) {
            foreach ($this->getSelectedColumnsForQuery() as $column) {
                if ($column->hasRelations()) {
                    $this->setBuilder($this->joinRelation($column));
                }
            }

        } else {
            foreach ($this->getColumns()->reject(fn (Column $column) => $column->isLabel()) as $column) {
                if ($column->hasRelations()) {
                    $this->setBuilder($this->joinRelation($column));
                }
            }
        }

        return $this->getBuilder();
    }

    protected function joinRelation(Column $column): Builder
    {
        if ($column->eagerLoadRelationsIsEnabled() || $this->eagerLoadAllRelationsIsEnabled()) {
            $this->setBuilder($this->getBuilder()->with($column->getRelationString()));
        }

        $table = false;
        $tableAlias = false;
        $foreign = false;
        $other = false;
        $lastAlias = false;
        $lastQuery = clone $this->getBuilder();

        foreach ($column->getRelations() as $i => $relationPart) {
            $model = $lastQuery->getRelation($relationPart);
            $tableAlias = $this->getTableAlias($tableAlias, $relationPart);

            switch (true) {
                case $model instanceof MorphOne:
                case $model instanceof HasOne:
                    $table = "{$model->getRelated()->getTable()} AS $tableAlias";
                    $foreign = "$tableAlias.{$model->getForeignKeyName()}";
                    $other = $i === 0
                        ? $model->getQualifiedParentKeyName()
                        : $lastAlias.'.'.$model->getLocalKeyName();

                    break;

                case $model instanceof BelongsTo:
                    $table = "{$model->getRelated()->getTable()} AS $tableAlias";
                    $foreign = $i === 0
                        ? $model->getQualifiedForeignKeyName()
                        : $lastAlias.'.'.$model->getForeignKeyName();

                    $other = "$tableAlias.{$model->getOwnerKeyName()}";

                    break;
            }

            if ($table) {
                $this->setBuilder($this->performJoin($table, $foreign, $other));
            }

            $lastAlias = $tableAlias;
            $lastQuery = $model->getQuery();
        }

        return $this->getBuilder();
    }

    protected function performJoin($table, $foreign, $other, $type = 'left'): Builder
    {
        $joins = [];

        foreach ($this->getBuilder()->getQuery()->joins ?? [] as $join) {
            $joins[] = $join->table;
        }

        if (! in_array($table, $joins, true)) {
            $this->setBuilder($this->getBuilder()->join($table, $foreign, '=', $other, $type));
        }

        return $this->getBuilder();
    }

    protected function selectFields(): Builder
    {
        // Load any additional selects that were not already columns
        foreach ($this->getAdditionalSelects() as $select) {
            $this->setBuilder($this->getBuilder()->addSelect($select));
        }

        if ($this->getExcludeDeselectedColumnsFromQuery()) {
            foreach ($this->getSelectedColumnsForQuery() as $column) {
                $this->setBuilder($this->getBuilder()->addSelect($column->getColumn().' as '.$column->getColumnSelectName()));
            }
        } else {
            foreach ($this->getColumns()->reject(fn (Column $column) => $column->isLabel()) as $column) {
                $this->setBuilder($this->getBuilder()->addSelect($column->getColumn().' as '.$column->getColumnSelectName()));
            }
        }

        return $this->getBuilder();
    }

    /**
     * Gets the table for a given Column
     */
    protected function getTableForColumn(Column $column): ?string
    {
        $table = null;
        $lastQuery = clone $this->getBuilder();

        foreach ($column->getRelations() as $relationPart) {
            $model = $lastQuery->getRelation($relationPart);

            if ($model instanceof HasOne || $model instanceof BelongsTo || $model instanceof MorphOne) {
                $table = $this->getTableAlias($table, $relationPart);
            }

            $lastQuery = $model->getQuery();
        }

        return $table;
    }

    /**
     * Retrieves table aliases
     */
    protected function getTableAlias(?string $currentTableAlias, string $relationPart): string
    {
        if (! $currentTableAlias) {
            return $relationPart;
        }

        return $currentTableAlias.'_'.$relationPart;
    }

    /**
     * The base query - typically overridden in child components
     */
    public function builder(): Builder
    {
        if ($this->hasModel()) {
            return $this->getModel()::query()->with($this->getRelationships());
        }

        // If model does not exist
        throw new DataTableConfigurationException('You must either specify a model or implement the builder method.');
    }

    /**
     * Add Rows And Generic Data to View
     */
    public function renderingWithData(\Illuminate\View\View $view, array $data = []): void
    {
        $view->with([
            'filterGenericData' => $this->getFilterGenericData(),
            'rows' => $this->getRows(),
        ]);
    }
}
