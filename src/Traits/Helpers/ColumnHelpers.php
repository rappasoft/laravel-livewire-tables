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

        $this->columns = $columns;
    }

    /**
     * @return Collection
     */
    public function getColumns(): Collection
    {
        return $this->columns;
    }

    /**
     * @param  string  $qualifiedColumn
     *
     * @return Column|null
     */
    public function getColumn(string $qualifiedColumn): ?Column
    {
        return $this->getColumns()
            ->filter(fn (Column $column) => $column->isColumn($qualifiedColumn))
            ->first();
    }

    /**
     * @param  string  $qualifiedColumn
     *
     * @return Column|null
     */
    public function getColumnBySelectName(string $qualifiedColumn): ?Column
    {
        return $this->getColumns()
            ->filter(fn (Column $column) => $column->isColumnBySelectName($qualifiedColumn))
            ->first();
    }

    /**
     * @return array
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
     * @return array
     */
    public function getColumnRelationStrings(): array
    {
        return $this->getColumns()
            ->filter(fn (Column $column) => $column->hasRelations())
            ->map(fn (Column $column) => $column->getRelationString())
            ->values()
            ->toArray();
    }

    /**
     * @return Collection
     */
    public function getSelectableColumns(): Collection
    {
        return $this->getColumns()
            ->reject(fn (Column $column) => $column->isLabel())
            ->values();
    }

    /**
     * @return Collection
     */
    public function getSearchableColumns(): Collection
    {
        return $this->getColumns()
            ->filter(fn (Column $column) => $column->isSearchable() || $column->hasSearchCallback())
            ->values();
    }

    /**
     * @return int
     */
    public function getColumnCount(): int
    {
        return $this->getColumns()->count();
    }

    /**
     * @return bool
     */
    public function hasCollapsedColumns(): bool
    {
        return $this->shouldCollapseOnMobile() + $this->shouldCollapseOnTablet() > 0;
    }

    /**
     * @return bool
     */
    public function shouldCollapseOnMobile(): bool
    {
        return $this->getCollapsedMobileColumnsCount();
    }

    /**
     * @return Collection
     */
    public function getCollapsedMobileColumns(): Collection
    {
        return $this->getColumns()
            ->filter(fn (Column $column) => $column->shouldCollapseOnMobile())
            ->values();
    }

    /**
     * @return int
     */
    public function getCollapsedMobileColumnsCount(): int
    {
        return $this->getCollapsedMobileColumns()->count();
    }

    /**
     * @return Collection
     */
    public function getVisibleMobileColumns(): Collection
    {
        return $this->getColumns()
            ->reject(fn (Column $column) => $column->shouldCollapseOnMobile())
            ->values();
    }

    /**
     * @return int
     */
    public function getVisibleMobileColumnsCount(): int
    {
        return $this->getVisibleMobileColumns()->count();
    }

    /**
     * @return bool
     */
    public function shouldCollapseOnTablet(): bool
    {
        return $this->getCollapsedTabletColumnsCount();
    }

    /**
     * @return Collection
     */
    public function getCollapsedTabletColumns(): Collection
    {
        return $this->getColumns()
            ->filter(fn (Column $column) => $column->shouldCollapseOnTablet())
            ->values();
    }

    /**
     * @return int
     */
    public function getCollapsedTabletColumnsCount(): int
    {
        return $this->getCollapsedTabletColumns()->count();
    }

    /**
     * @return Collection
     */
    public function getVisibleTabletColumns(): Collection
    {
        return $this->getColumns()
            ->reject(fn (Column $column) => $column->shouldCollapseOnTablet())
            ->values();
    }

    /**
     * @return int
     */
    public function getVisibleTabletColumnsCount(): int
    {
        return $this->getVisibleTabletColumns()->count();
    }

    // TODO
    public function getColspanCount(): int
    {
        $all = $this->getColumnCount();

        // If Reordering is enabled, but we're hiding the sort column
        if ($this->reorderIsEnabled() && $this->hideReorderColumnUnlessReorderingIsEnabled()) {
            $all--;
        }

        // If reordering is enabled, and we are currently reordering, account for the drag and drop handle
        if ($this->reorderIsEnabled() && $this->currentlyReorderingIsEnabled()) {
            $all++;
        }

        // If bulk actions are enabled, account for the checkbox column
        if ($this->bulkActionsAreEnabled() && $this->hasBulkActions()) {
            $all++;
        }

        return $all;
    }
}
