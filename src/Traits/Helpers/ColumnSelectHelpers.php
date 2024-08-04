<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Helpers;

use Illuminate\Support\Collection;
use Rappasoft\LaravelLivewireTables\Events\ColumnsSelected;
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

    public function getVisibleColumns(): array
    {
        return $this->getColumns()
            ->reject(fn (Column $column) => $column->isHidden())
            ->reject(fn (Column $column) => ($column->isSelectable() && ! $this->columnSelectIsEnabledForColumn($column)))
            ->values()
            ->toArray();
    }

    public function selectAllColumns(): void
    {
        $this->selectedColumns = [];
        foreach ($this->getColumns() as $column) {
            $this->selectedColumns[] = $column->getSlug();
        }
        $this->forgetColumnSelectSession();
        if ($this->getEventStatusColumnSelect()) {
            event(new ColumnsSelected($this->getTableName(), $this->getColumnSelectSessionKey(), $this->selectedColumns));
        }
    }

    public function deselectAllColumns(): void
    {
        $this->selectedColumns = [];
        session([$this->getColumnSelectSessionKey() => []]);
        if ($this->getEventStatusColumnSelect()) {
            event(new ColumnsSelected($this->getTableName(), $this->getColumnSelectSessionKey(), $this->selectedColumns));
        }
    }

    public function allVisibleColumnsAreSelected(): bool
    {
        return count($this->selectedColumns) === count($this->getDefaultVisibleColumns());
    }

    public function allSelectedColumnsAreVisibleByDefault(): bool
    {
        return count($this->selectedColumns) === count($this->getDefaultVisibleColumns());
    }

    public function setupColumnSelect(): void
    {

        // If the column select is off, make sure to clear the session
        if ($this->columnSelectIsDisabled() && session()->has($this->getColumnSelectSessionKey())) {
            session()->forget($this->getColumnSelectSessionKey());

            return;
        }

        if (empty($this->selectableColumns)) {
            $this->selectableColumns = $this->getColumnsForColumnSelect();
        }
        $this->setupFirstColumnSelectRun();

        $this->defaultVisibleColumnCount = count($this->selectableColumns);

        // If remember selection is off, then clear the session
        if ($this->rememberColumnSelectionIsDisabled()) {
            $this->forgetColumnSelectSession();
        }

        // Set to either the default set or what is stored in the session
        $this->selectedColumns = (count($this->selectedColumns) > 1) ?
            $this->selectedColumns :
            session()->get($this->getColumnSelectSessionKey(), $this->getDefaultVisibleColumns());

        // Check to see if there are any excluded that are already stored in the enabled and remove them
        foreach ($this->getColumns() as $column) {
            if (! $column->isSelectable() && ! in_array($column->getSlug(), $this->selectedColumns, true)) {
                $this->selectedColumns[] = $column->getSlug();
                session([$this->getColumnSelectSessionKey() => $this->selectedColumns]);
            }
        }
        $this->visibleColumnCount = count($this->selectedColumns);
    }

    protected function setupFirstColumnSelectRun(): void
    {
        if (! $this->columnSelectColumns['setupRun']) {
            $this->columnSelectColumns['deselected'] = $this->columnSelectColumns['defaultdeselected'] = $this->setDefaultDeselectedColumns();
            $this->columnSelectColumns['setupRun'] = true;
        }

    }
}
