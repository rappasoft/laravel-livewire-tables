<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Helpers;

use Illuminate\Support\Collection;
use Rappasoft\LaravelLivewireTables\Views\Column;

trait ColumnSelectHelpers
{
    public function getColumnSelectStatus(): bool
    {
        return $this->columnSelectStatus;
    }

    public function columnSelectIsEnabled(): bool
    {
        return $this->getColumnSelectStatus() === true;
    }

    public function columnSelectIsDisabled(): bool
    {
        return $this->getColumnSelectStatus() === false;
    }

    public function getRememberColumnSelectionStatus(): bool
    {
        return $this->rememberColumnSelectionStatus;
    }

    public function rememberColumnSelectionIsEnabled(): bool
    {
        return $this->getRememberColumnSelectionStatus() === true;
    }

    public function rememberColumnSelectionIsDisabled(): bool
    {
        return $this->getRememberColumnSelectionStatus() === false;
    }

    public function columnSelectIsEnabledForColumn(mixed $column): bool
    {
        return in_array($column instanceof Column ? $column->getSlug() : $column, $this->selectedColumns, true);
    }

    protected function forgetColumnSelectSession(): void
    {
        session()->forget($this->getColumnSelectSessionKey());
    }

    protected function getColumnSelectSessionKey(): string
    {
        return $this->getDataTableFingerprint().'-columnSelectEnabled';
    }

    public function getColumnSelectIsHiddenOnTablet(): bool
    {
        return $this->columnSelectHiddenOnTablet;
    }

    public function getExcludeDeselectedColumnsFromQuery(): bool
    {
        return $this->excludeDeselectedColumnsFromQuery;
    }

    public function getColumnSelectIsHiddenOnMobile(): bool
    {
        return $this->columnSelectHiddenOnMobile;
    }

    public function getSelectableColumns(): Collection
    {
        return $this->getColumns()
            ->reject(fn (Column $column) => $column->isHidden())
            ->reject(fn (Column $column) => ! $column->isSelectable())
            ->values();
    }

    public function getSelectableSelectedColumns(): Collection
    {
        return $this->getColumns()
            ->reject(fn (Column $column) => $column->isHidden())
            ->reject(fn (Column $column) => ! $column->isSelectable())
            ->reject(fn (Column $column) => ! $this->columnSelectIsEnabledForColumn($column))
            ->values();
    }

    public function getCurrentlySelectedCols(): void
    {
        $this->defaultVisibleColumnCount = count($this->getDefaultVisibleColumns());
        $this->visibleColumnCount = count(array_intersect($this->selectedColumns, $this->getDefaultVisibleColumns()));
    }

    public function getColsForData(): Collection
    {
        $selectableCols = $this->getSelectableColumns();
        $unSelectableCols = $this->getUnSelectableColumns();

        return $selectableCols->merge($unSelectableCols);
    }

    public function getUnSelectableColumns(): Collection
    {
        return $this->getColumns()
            ->reject(fn (Column $column) => $column->isHidden())
            ->reject(fn (Column $column) => $column->isSelectable())
            ->values();
    }

    public function getSelectedColumns(): array
    {
        return $this->selectedColumns ?? [];
    }

    public function getSelectedColumnsForQuery(): array
    {
        return $this->getColumns()
            ->reject(fn (Column $column) => $column->isLabel())
            ->reject(fn (Column $column) => $column->isHidden())
            ->reject(fn (Column $column) => ($column->isSelectable() && ! $this->columnSelectIsEnabledForColumn($column)))
            ->values()
            ->toArray();
    }

    public function getColumnsForColumnSelect(): array
    {
        return $this->getColumns()
            ->reject(fn (Column $column) => ! $column->isSelectable())
            ->reject(fn (Column $column) => $column->isHidden())
            ->keyBy(function (Column $column, int $key) {
                return $column->getSlug();
            })
            ->map(fn ($column) => $column->getTitle())
            ->toArray();
    }

    public function getDefaultVisibleColumns(): array
    {
        return collect($this->getColumns()
            ->reject(fn (Column $column) => $column->isHidden())
            ->reject(fn (Column $column) => $column->isSelectable() && ! $column->isSelected())

        )
            ->map(fn ($column) => $column->getSlug())
            ->values()
            ->toArray();
    }

    public function getAllColumnsAreSelected(): bool
    {
        return $this->getSelectableSelectedColumns()->count() === $this->getSelectableColumns()->count();
    }
}
