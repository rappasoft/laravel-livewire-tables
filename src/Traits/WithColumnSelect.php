<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Rappasoft\LaravelLivewireTables\Traits\Configuration\ColumnSelectConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Helpers\ColumnSelectHelpers;

trait WithColumnSelect
{
    use ColumnSelectConfiguration,
        ColumnSelectHelpers;

    public array $selectedColumns = [];
    protected bool $columnSelectStatus = true;
    protected bool $rememberColumnSelectionStatus = true;

    public function setupColumnSelect(): void
    {
        // If remember selection is off, then clear the session
        if ($this->rememberColumnSelectionIsDisabled()) {
            $this->forgetColumnSelectSession();
        }

        // If the column select is off, make sure to clear the session
        if ($this->columnSelectIsDisabled() && session()->has($this->getColumnSelectSessionKey())) {
            session()->forget($this->getColumnSelectSessionKey());
        }

        // Get a list of visible default columns that are not excluded
        $columns = collect($this->getColumns())
            ->filter(function ($column) {
                return $column->isVisible() && $column->isSelectable() && $column->isSelected();
            })
            ->map(fn ($column) => $column->getField())
            ->values()
            ->toArray();

        // Set to either the default set or what is stored in the session
        $this->selectedColumns = count($this->userSelectedColumns) > 0 ?
            $this->userSelectedColumns :
            session()->get($this->getColumnSelectSessionKey(), $columns);

        // Check to see if there are any excluded that are already stored in the enabled and remove them
        foreach ($this->getColumns() as $column) {
            if (! $column->isSelectable() && ! in_array($column->getField(), $this->selectedColumns, true)) {
                $this->selectedColumns[] = $column->getField();
                session([$this->getColumnSelectSessionKey() => $this->selectedColumns]);
            }
        }
    }

    public function updatedSelectedColumns(): void
    {
        $this->userSelectedColumns = $this->selectedColumns;
        session([$this->getColumnSelectSessionKey() => $this->userSelectedColumns]);
    }
}
