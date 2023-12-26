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

    public array $columnSelectColumns = ['setupRun' => false, 'selected' => [], 'deselected' => [], 'defaultdeselected' => []];

    public array $selectedColumns = [];

    public array $deselectedColumns = [];

    public array $selectableColumns = [];

    public array $defaultDeselectedColumns = [];

    protected bool $columnSelectStatus = true;

    protected bool $rememberColumnSelectionStatus = true;

    protected bool $columnSelectHiddenOnMobile = false;

    protected bool $columnSelectHiddenOnTablet = false;

    public bool $excludeDeselectedColumnsFromQuery = false;

    public bool $defaultDeselectedColumnsSetup = false;

    protected function queryStringWithColumnSelect(): array
    {
        if ($this->queryStringIsEnabled() && $this->columnSelectIsEnabled()) {
            return [
                'columns' => ['except' => null, 'history' => false, 'keep' => false, 'as' => $this->getQueryStringAlias().'-columns'],
            ];
        }

        return [];
    }

    public function bootedWithColumnSelect(): void
    {
        $this->setupColumnSelect();
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

    public function selectAllColumns(): void
    {
        $this->selectedColumns = [];
        foreach ($this->getColumns() as $column) {
            $this->selectedColumns[] = $column->getSlug();
        }
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
