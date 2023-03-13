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

    /**
     * @return Builder
     */
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

    /**
     * @return Builder
     */
    protected function joinRelations(): Builder
    {
        foreach ($this->getSelectableColumns() as $column) {
            if ($column->hasRelations()) {
                $this->setBuilder($this->joinRelation($column));
            }
        }

        return $this->getBuilder();
    }

    /**
     * @param Column $column
     *
     * @return Builder
     */
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

    /**
     * @param mixed $table
     * @param mixed $foreign
     * @param mixed $other
     * @param string $type
     *
     * @return Builder
     */
    protected function performJoin($table, $foreign, $other, $type = 'left'): Builder
    {
        $joins = [];

        /** @phpstan-ignore-next-line */
        foreach ($this->getBuilder()->getQuery()->joins ?? [] as $join) {
            $joins[] = $join->table;
        }

        if (! in_array($table, $joins, true)) {
            $this->setBuilder($this->getBuilder()->join($table, $foreign, '=', $other, $type));
        }

        return $this->getBuilder();
    }

    /**
     * @return Builder
     */
    protected function selectFields(): Builder
    {
        // Load any additional selects that were not already columns
        foreach ($this->getAdditionalSelects() as $select) {
            $this->setBuilder($this->getBuilder()->addSelect($select));
        }

        // Load any additional selects that were not already columns
        $rawCount = 1;
        foreach ($this->getAdditionalSelectRaws() as $selectRaw) {
            if (is_array($selectRaw)) {
                if (strpos($selectRaw[0], 'as') === false) {
                    $selectRaw[0] .= ' as rawSelect'.$rawCount;
                }
                $this->setBuilder($this->getBuilder()->selectRaw($selectRaw[0], (is_array($selectRaw[1]) ? $selectRaw[1] : [$selectRaw[1]])));
            } else {
                $this->setBuilder($this->getBuilder()->selectRaw($selectRaw));
            }
            $rawCount++;
        }

        foreach ($this->getSelectableColumns() as $column) {
            $this->setBuilder($this->getBuilder()->addSelect($column->getColumn() . ' as ' .$column->getColumnSelectName()));
        }

        return $this->getBuilder();
    }

    /**
     * @param Column $column
     *
     * @return string|null
     */
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

    /**
     * @return string
     */
    protected function getQuerySql(): string
    {
        return (clone $this->getBuilder())->toSql();
    }
}
