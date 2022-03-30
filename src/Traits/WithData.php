<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Rappasoft\LaravelLivewireTables\Views\Column;

trait WithData
{
    // TODO: Test
    public function getRows()
    {
        return $this->executeQuery($this->baseQuery());
    }

    protected function baseQuery(): Builder
    {
        $builder = $this->joinRelations($this->builder());

        $builder = $this->selectFields($builder);

        $builder = $this->applySearch($builder);

        $builder = $this->applyFilters($builder);

        if ($this->currentlyReorderingIsEnabled()) {
            return $builder->orderBy($this->getDefaultReorderColumn(), $this->getDefaultReorderDirection());
        }

        return $this->applySorting($builder);
    }

    protected function executeQuery(Builder $builder)
    {
        return $this->paginationIsEnabled() ?
            $builder->paginate($this->getPerPage() === -1 ? $builder->count() : $this->getPerPage(), ['*'], $this->getComputedPageName()) :
            $builder->get();
    }

    protected function joinRelations(Builder $builder): Builder
    {
        foreach ($this->getSelectableColumns() as $column) {
            if ($column->hasRelations()) {
                $builder = $this->joinRelation($builder, $column);
            }
        }

        return $builder;
    }

    protected function joinRelation(Builder $builder, Column $column): Builder
    {
        if ($column->eagerLoadRelationsIsEnabled() || $this->eagerLoadAllRelationsIsEnabled()) {
            $builder->with($column->getRelationString());
        }

        $table = false;
        $foreign = false;
        $other = false;
        $lastQuery = $builder;

        foreach ($column->getRelations() as $relationPart) {
            $model = $lastQuery->getRelation($relationPart);

            switch (true) {
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
                $builder = $this->performJoin($builder, $table, $foreign, $other);
            }

            $lastQuery = $model->getQuery();
        }

        return $builder;
    }

    protected function performJoin(Builder $builder, $table, $foreign, $other, $type = 'left'): Builder
    {
        $joins = [];

        foreach ($builder->getQuery()->joins ?? [] as $join) {
            $joins[] = $join->table;
        }

        if (! in_array($table, $joins, true)) {
            $builder->join($table, $foreign, '=', $other, $type);
        }

        return $builder;
    }

    protected function selectFields(Builder $builder): Builder
    {
        foreach ($this->getSelectableColumns() as $column) {
            $builder->addSelect($column->getColumn() . ' as ' .$column->getColumnSelectName());
        }

        return $builder;
    }

    protected function getTableForColumn(Column $column): ?string
    {
        $table = null;
        $lastQuery = $this->builder();

        foreach ($column->getRelations() as $relationPart) {
            $model = $lastQuery->getRelation($relationPart);

            if ($model instanceof HasOne || $model instanceof BelongsTo) {
                $table = $model->getRelated()->getTable();
            }

            $lastQuery = $model->getQuery();
        }

        return $table;
    }

    protected function getQuerySql(): string
    {
        return $this->baseQuery()->toSql();
    }
}
