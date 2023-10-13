<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Helpers;

use Illuminate\Support\Collection;
use Rappasoft\LaravelLivewireTables\Views\Column;

trait ColumnHelpers
{
    /**
     * Set the user defined columns
     */
    public function setColumns(): void
    {
        $this->prependedColumns = $this->getPrependedColumns();

        $columns = collect($this->columns())
            ->filter(fn ($column) => $column instanceof Column)
            ->map(function (Column $column) {
                $column->setComponent($this);

                if ($column->hasField()) {
                    if ($column->isBaseColumn()) {
                        $column->setTable($this->getBuilder()->getModel()->getTable());
                    } else {
                        $column->setTable($this->getTableForColumn($column));
                    }
                }

                return $column;
            });

        $this->appendedColumns = $this->getAppendedColumns();

        $this->columns = collect([...$this->prependedColumns, ...$columns, ...$this->appendedColumns]);
    }

    public function getColumns(): Collection
    {
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

    public function hasCollapsedColumns(): bool
    {
        if ($this->shouldCollapseOnMobile() || $this->shouldCollapseOnTablet() || $this->shouldCollapseAlways()) {
            return true;
        }

        return false;
    }

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
        return collect($this->prependedColumns ?? $this->prependColumns())
            ->filter(fn ($column) => $column instanceof Column)
            ->map(function (Column $column) {
                $column->setComponent($this);

                if ($column->hasField()) {
                    if ($column->isBaseColumn()) {
                        $column->setTable($this->getBuilder()->getModel()->getTable());
                    } else {
                        $column->setTable($this->getTableForColumn($column));
                    }
                }

                return $column;
            });
    }

    public function getAppendedColumns(): Collection
    {
        return collect($this->appendedColumns ?? $this->appendColumns())
            ->filter(fn ($column) => $column instanceof Column)
            ->map(function (Column $column) {
                $column->setComponent($this);

                if ($column->hasField()) {
                    if ($column->isBaseColumn()) {
                        $column->setTable($this->getBuilder()->getModel()->getTable());
                    } else {
                        $column->setTable($this->getTableForColumn($column));
                    }
                }

                return $column;
            });

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

    public function shouldCollapseAlways(): bool
    {
        if (! isset($this->shouldAlwaysCollapse)) {
            $this->shouldAlwaysCollapse = ($this->getCollapsedAlwaysColumnsCount() > 0);
        }

        return $this->shouldAlwaysCollapse;
    }
}
