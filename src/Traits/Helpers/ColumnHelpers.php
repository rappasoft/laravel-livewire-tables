<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Helpers;

use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\AggregateColumn;

trait ColumnHelpers
{
    /**
     * Set the user defined columns
     */
    public function setColumns(): void
    {
        $columns = collect($this->getPrependedColumns())->concat($this->columns())->concat(collect($this->getAppendedColumns()));
        $this->columns = $columns->filter(fn ($column) => $column instanceof Column);
    }

    protected function setupColumns(): void
    {
        $this->columns = $this->columns
            ->filter(fn ($column) => $column instanceof Column)
            ->map(function (Column $column) {
                $column->setTheme($this->getTheme())
                    ->setHasTableRowUrl($this->hasTableRowUrl())
                    ->setIsReorderColumn($this->getDefaultReorderColumn() == $column->getField());

                if ($column instanceof AggregateColumn) {
                    if ($column->getAggregateMethod() == 'count' && $column->hasDataSource()) {
                        $this->addExtraWithCount($column->getDataSource());
                    } elseif ($column->getAggregateMethod() == 'sum' && $column->hasDataSource() && $column->hasForeignColumn()) {
                        $this->addExtraWithSum($column->getDataSource(), $column->getForeignColumn());
                    } elseif ($column->getAggregateMethod() == 'avg' && $column->hasDataSource() && $column->hasForeignColumn()) {
                        $this->addExtraWithAvg($column->getDataSource(), $column->getForeignColumn());
                    }
                }

                if ($column->hasField()) {
                    if ($column->isBaseColumn()) {
                        $column->setTable($this->getBuilder()->getModel()->getTable());
                    } else {
                        $column->setTable($this->getTableForColumn($column));
                    }
                }

                return $column;
            });

        $this->hasRunColumnSetup = true;
    }

    public function getColumns(): Collection
    {
        if (! $this->hasRunColumnSetup) {
            $this->setupColumns();
        }

        return $this->columns;
    }

    public function getColumn(string $qualifiedColumn): ?Column
    {
        return $this->getColumns()
            ->filter(fn (Column $column) => $column->isColumn($qualifiedColumn))
            ->first();
    }

    public function getColumnBySelectName(string $qualifiedColumn): ?Column
    {
        return $this->getColumns()
            ->filter(fn (Column $column) => $column->isColumnBySelectName($qualifiedColumn))
            ->first();
    }

    public function getColumnBySlug(string $columnSlug): ?Column
    {
        return $this->getColumns()
            ->filter(fn (Column $column) => $column->isColumnBySlug($columnSlug))
            ->first();
    }

    /**
     * @return array<mixed>
     */
    public function getColumnRelations(): array
    {
        return $this->getColumns()
            ->filter(fn (Column $column) => $column->hasRelations())
            ->map(fn (Column $column) => $column->getRelations())
            ->values()
            ->toArray();
    }

    /**
     * @return array<mixed>
     */
    public function getColumnRelationStrings(): array
    {
        return $this->getColumns()
            ->filter(fn (Column $column) => $column->hasRelations())
            ->map(fn (Column $column) => $column->getRelationString())
            ->values()
            ->toArray();
    }

    public function getSearchableColumns(): Collection
    {
        return $this->getColumns()
            ->filter(fn (Column $column) => $column->isSearchable() || $column->hasSearchCallback())
            ->values();
    }

    public function getSortableColumns(): Collection
    {
        return isset($this->sortableColumns) ? $this->sortableColumns : $this->sortableColumns = $this->getColumns()
            ->filter(fn (Column $column) => ($column->isSortable() || $column->hasSortCallback()))
            ->map(fn (Column $column) => $column->getColumnSelectName() ?? $column->getSlug())
            ->values();
    }

    public function getColumnCount(): int
    {
        return $this->getColumns()->count();
    }

    #[Computed]
    public function hasCollapsedColumns(): bool
    {
        if ($this->shouldCollapseOnMobile() || $this->shouldCollapseOnTablet() || $this->shouldCollapseAlways()) {
            return true;
        }

        return false;
    }

    #[Computed]
    public function shouldCollapseOnMobile(): bool
    {

        if (! isset($this->shouldMobileCollapse)) {
            $this->shouldMobileCollapse = ($this->getCollapsedMobileColumnsCount() > 0);
        }

        return $this->shouldMobileCollapse;

    }

    public function getCollapsedMobileColumns(): Collection
    {
        return $this->getColumns()
            ->reject(fn (Column $column) => $column->isHidden())
            ->reject(fn (Column $column) => ($column->isSelectable() && ! $this->columnSelectIsEnabledForColumn($column)))
            ->filter(fn (Column $column) => $column->shouldCollapseOnMobile())
            ->values();
    }

    public function getCollapsedMobileColumnsCount(): int
    {
        return $this->getCollapsedMobileColumns()->count();
    }

    public function getVisibleMobileColumns(): Collection
    {
        return $this->getColumns()
            ->reject(fn (Column $column) => $column->shouldCollapseOnMobile())
            ->values();
    }

    public function getVisibleMobileColumnsCount(): int
    {
        return $this->getVisibleMobileColumns()->count();
    }

    #[Computed]
    public function shouldCollapseOnTablet(): bool
    {
        if (! isset($this->shouldTabletCollapse)) {
            $this->shouldTabletCollapse = ($this->getCollapsedTabletColumnsCount() > 0);
        }

        return $this->shouldTabletCollapse;

    }

    public function getCollapsedTabletColumns(): Collection
    {
        return $this->getColumns()
            ->reject(fn (Column $column) => $column->isHidden())
            ->reject(fn (Column $column) => ($column->isSelectable() && ! $this->columnSelectIsEnabledForColumn($column)))
            ->filter(fn (Column $column) => $column->shouldCollapseOnTablet())
            ->values();
    }

    public function getCollapsedTabletColumnsCount(): int
    {
        return $this->getCollapsedTabletColumns()->count();
    }

    public function getVisibleTabletColumns(): Collection
    {
        return $this->getColumns()
            ->reject(fn (Column $column) => $column->shouldCollapseOnTablet())
            ->values();
    }

    public function getVisibleTabletColumnsCount(): int
    {
        return $this->getVisibleTabletColumns()->count();
    }

    public function getColspanCount(): int
    {
        return 100;
    }

    public function getPrependedColumns(): Collection
    {
        return $this->prependedColumns ?? collect($this->prependColumns());
    }

    public function getAppendedColumns(): Collection
    {
        return $this->appendedColumns ?? collect($this->appendColumns());
    }

    public function getCollapsedAlwaysColumns(): Collection
    {
        return $this->getColumns()
            ->reject(fn (Column $column) => $column->isHidden())
            ->reject(fn (Column $column) => ($column->isSelectable() && ! $this->columnSelectIsEnabledForColumn($column)))
            ->filter(fn (Column $column) => $column->shouldCollapseAlways())
            ->values();
    }

    public function getCollapsedAlwaysColumnsCount(): int
    {
        return $this->getCollapsedAlwaysColumns()->count();
    }

    #[Computed]
    public function shouldCollapseAlways(): bool
    {
        if (! isset($this->shouldAlwaysCollapse)) {
            $this->shouldAlwaysCollapse = ($this->getCollapsedAlwaysColumnsCount() > 0);
        }

        return $this->shouldAlwaysCollapse;
    }

    /**
     * Prepend columns.
     */
    public function prependColumns(): array
    {
        return [];
    }

    /**
     * Append columns.
     */
    public function appendColumns(): array
    {
        return [];
    }
}
