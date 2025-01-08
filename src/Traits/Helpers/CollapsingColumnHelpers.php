<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Helpers;

use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Rappasoft\LaravelLivewireTables\Views\Column;

trait CollapsingColumnHelpers
{
    public function getCollapsingColumnsStatus(): bool
    {
        return $this->collapsingColumnsStatus;
    }

    #[Computed]
    public function hasCollapsingColumns(): bool
    {
        return $this->getCollapsingColumnsStatus() === true;
    }

    #[Computed]
    public function collapsingColumnsAreEnabled(): bool
    {
        return $this->getCollapsingColumnsStatus() === true;
    }

    #[Computed]
    public function collapsingColumnsAreDisabled(): bool
    {
        return $this->getCollapsingColumnsStatus() === false;
    }

    #[Computed]
    public function showCollapsingColumnSections(): bool
    {
        return $this->collapsingColumnsAreEnabled() && $this->hasCollapsedColumns();
    }

    #[Computed]
    public function hasCollapsedColumns(): bool
    {
        return $this->hasCollapsingColumns() && ($this->shouldCollapseOnMobile() || $this->shouldCollapseOnTablet() || $this->shouldCollapseAlways());
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
            ->reject(fn (Column $column) => ($column->isHidden() || ($column->isSelectable() && ! $this->columnSelectIsEnabledForColumn($column))))
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
            ->reject(fn (Column $column) => ($column->isHidden() || ($column->isSelectable() && ! $this->columnSelectIsEnabledForColumn($column))))
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

    public function getCollapsedAlwaysColumns(): Collection
    {
        return $this->getColumns()
            ->reject(fn (Column $column) => ($column->isHidden() || ($column->isSelectable() && ! $this->columnSelectIsEnabledForColumn($column))))
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

    #[Computed]
    public function getColspanCount(): int
    {
        return 100;
    }

    #[Computed]
    public function getCollapsedColumnsForContent(): Collection
    {
        $colspan = $this->getColspanCount();
        $columns = $this->getColumns()
            ->reject(fn (Column $column) => ($column->isHidden() || ($column->isSelectable() && ! $this->columnSelectIsEnabledForColumn($column))))
            ->reject(fn (Column $column) => $column->shouldNeverCollapse());

        return $columns;
    }
}
