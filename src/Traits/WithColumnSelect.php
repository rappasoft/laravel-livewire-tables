<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Trait WithColumnSelect.
 */
trait WithColumnSelect
{
    public bool $columnSelect = false;
    public array $columnSelectEnabled = [];

    public function mountWithColumnSelect(): void
    {
        // If the column select is off, make sure to clear the session
        if (! $this->columnSelect && session()->has($this->getColumnSelectSessionKey())) {
            session()->forget($this->getColumnSelectSessionKey());
        }

        // Get a list of visible default columns that are not excluded
        $columns = collect($this->columns())
            ->filter(fn ($column) => $column->isVisible() && $column->isSelectable())
            ->map(fn ($column) => $column->column())
            ->values()
            ->toArray();

        // Set to either the default set or what is stored in the session
        $this->columnSelectEnabled = session()->get($this->getColumnSelectSessionKey(), $columns);

        // Check to see if there are any excluded that are already stored in the enabled and remove them
        foreach ($this->columns() as $column) {
            if (! $column->isSelectable() && ! in_array($column->column(), $this->columnSelectEnabled, true)) {
                $this->columnSelectEnabled[] = $column->column();
                session([$this->getColumnSelectSessionKey() => $this->columnSelectEnabled]);
            }
        }
    }

    public function updatedColumnSelectEnabled(): void
    {
        session([$this->getColumnSelectSessionKey() => $this->columnSelectEnabled]);
    }

    public function isColumnSelectEnabled($column): bool
    {
        return in_array($column instanceof Column ? $column->column() : $column, $this->columnSelectEnabled, true);
    }

    private function getColumnSelectSessionKey(): string
    {
        return $this->tableName.'-columnSelectEnabled';
    }
}
