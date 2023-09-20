<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Rappasoft\LaravelLivewireTables\Events\ColumnsSelected;
use Rappasoft\LaravelLivewireTables\Traits\Configuration\ColumnSelectConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Helpers\ColumnSelectHelpers;
use Rappasoft\LaravelLivewireTables\Views\Column;

trait WithColumnSelect
{
    use ColumnSelectConfiguration,
        ColumnSelectHelpers;

    public array $selectedColumns = [];

    public array $selectableColumns = [];

    protected bool $columnSelectStatus = true;

    protected bool $rememberColumnSelectionStatus = true;

    protected bool $columnSelectHiddenOnMobile = false;

    protected bool $columnSelectHiddenOnTablet = false;

    protected bool $excludeDeselectedColumnsFromQuery = false;

    public function setupColumnSelect(): void
    {
        if (empty($this->selectableColumns)) {
            $this->selectableColumns = $this->getColumnsForColumnSelect();
        }

        $this->defaultVisibleColumnCount = count($this->selectableColumns);

        // If remember selection is off, then clear the session
        if ($this->rememberColumnSelectionIsDisabled()) {
            $this->forgetColumnSelectSession();
        }

        // If the column select is off, make sure to clear the session
        if ($this->columnSelectIsDisabled() && session()->has($this->getColumnSelectSessionKey())) {
            session()->forget($this->getColumnSelectSessionKey());
        }

        // Set to either the default set or what is stored in the session
        $this->selectedColumns = (isset($this->selectedColumns) && count($this->selectedColumns) > 0) ?
            $this->selectedColumns :
            session()->get($this->getColumnSelectSessionKey(), $this->getDefaultVisibleColumns()) ?? [];

        // Check to see if there are any excluded that are already stored in the enabled and remove them
        foreach ($this->getColumns() as $column) {
            if (! $column->isSelectable() && ! in_array($column->getSlug(), $this->selectedColumns, true)) {
                $this->selectedColumns[] = $column->getSlug();
                session([$this->getColumnSelectSessionKey() => $this->selectedColumns]);
            }
        }
        $this->visibleColumnCount = count($this->selectedColumns);
    }

    public function selectAllColumns(): void
    {
        $this->selectedColumns = $this->getDefaultVisibleColumns();
        $this->forgetColumnSelectSession();
        event(new ColumnsSelected($this->getColumnSelectSessionKey(), $this->selectedColumns));
    }

    public function deselectAllColumns(): void
    {
        $this->selectedColumns = [];
        session([$this->getColumnSelectSessionKey() => []]);
        event(new ColumnsSelected($this->getColumnSelectSessionKey(), $this->selectedColumns));
    }

    public function updatedSelectedColumns(): void
    {
        // The query string isn't needed if it's the same as the default
        session([$this->getColumnSelectSessionKey() => $this->selectedColumns]);
        event(new ColumnsSelected($this->getColumnSelectSessionKey(), $this->selectedColumns));
    }

    public function allVisibleColumnsAreSelected(): bool
    {
        return count($this->selectedColumns) === count($this->getDefaultVisibleColumns());
    }

    public function allSelectedColumnsAreVisibleByDefault(): bool
    {
        return count($this->selectedColumns) === count($this->getDefaultVisibleColumns());
    }
}
