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
    public bool $usesSelect = false;
    public bool $rememberColumnSelection = true;

    public function mountWithColumnSelect(): void
    {
        if (! $this->rememberColumnSelection) {
            $this->forgetColumnSelectSession();
        }

        // If the column select is off, make sure to clear the session
        if (! $this->columnSelect && session()->has($this->getColumnSelectSessionKey())) {
            session()->forget($this->getColumnSelectSessionKey());
        }

        // If any of the columns are user selected
        if (collect($this->columns())->filter(fn ($column) => $column->isSelected())->count() > 0) {
            $this->usesSelect = true;
        }

        // Get a list of visible default columns that are not excluded
        $columns = collect($this->columns())
            ->filter(function ($column) {
                if ($this->usesSelect) {
                    return $column->isVisible() && $column->isSelectable() && $column->isSelected();
                }

                return $column->isVisible() && $column->isSelectable();
            })
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

    private function forgetColumnSelectSession(): void
    {
        session()->forget($this->getColumnSelectSessionKey());
    }

    private function getColumnSelectSessionKey(): string
    {
        return $this->tableName.'-columnSelectEnabled';
    }
}
