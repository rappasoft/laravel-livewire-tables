<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Rappasoft\LaravelLivewireTables\Views\Column;

trait WithData
{
    // TODO: Test
    public function getRows()
    {
        $this->baseQuery();

        return $this->executeQuery();
    }

    protected function baseQuery(): Builder
    {
        $this->setBuilder($this->joinRelations());

        $this->setBuilder($this->selectFields());

        $this->setBuilder($this->applySearch());

        $this->setBuilder($this->applyFilters());

        if ($this->currentlyReorderingIsEnabled()) {
            $this->setBuilder($this->getBuilder()->orderBy($this->getDefaultReorderColumn(), $this->getDefaultReorderDirection()));

            return $this->getBuilder();
        }

        return $this->applySorting();
    }

    protected function executeQuery()
    {
        if ($this->paginationIsEnabled()) {
            if ($this->isPaginationMethod('standard')) {
                return $this->getBuilder()->paginate($this->getPerPage() === -1 ? $this->getBuilder()->count() : $this->getPerPage(), ['*'], $this->getComputedPageName());
            }

            if ($this->isPaginationMethod('simple')) {
                return $this->getBuilder()->simplePaginate($this->getPerPage() === -1 ? $this->getBuilder()->count() : $this->getPerPage(), ['*'], $this->getComputedPageName());
            }
        }

        return $this->getBuilder()->get();
    }

    protected function joinRelations(): Builder
    {
        foreach ($this->getSelectableColumns() as $column) {
            if ($column->hasRelations()) {
                $this->setBuilder($this->joinRelation($column));
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
        $foreign = false;
        $other = false;
        $lastQuery = clone $this->getBuilder();

        foreach ($column->getRelations() as $relationPart) {
            $model = $lastQuery->getRelation($relationPart);

            switch (true) {
                case $model instanceof MorphOne:
                case $model instanceof HasOne:
                    $table = $model->getRelated()->getTable();
                    $foreign = $model->getQualifiedForeignKeyName();
                    $other = $model->getQualifiedParentKeyName();

                    break;

                case $model instanceof BelongsTo:
                    $table = $model->getRelated()->getTable();
                    $foreign = $model->getQualifiedForeignKeyName();
                    $other = $model->getQualifiedOwnerKeyName();

                    break;
            }

            if ($table) {
                $this->setBuilder($this->performJoin($table, $foreign, $other));
            }

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

        foreach ($this->getSelectableColumns() as $column) {
            $this->setBuilder($this->getBuilder()->addSelect($column->getColumn() . ' as ' .$column->getColumnSelectName()));
        }

        return $this->getBuilder();
    }

    protected function getTableForColumn(Column $column): ?string
    {
        $table = null;
        $lastQuery = clone $this->getBuilder();

        foreach ($column->getRelations() as $relationPart) {
            $model = $lastQuery->getRelation($relationPart);

            if ($model instanceof HasOne || $model instanceof BelongsTo || $model instanceof MorphOne) {
                $table = $model->getRelated()->getTable();
            }

            $lastQuery = $model->getQuery();
        }

        return $table;
    }

    protected function getQuerySql(): string
    {
        return (clone $this->getBuilder())->toSql();
    }
}
