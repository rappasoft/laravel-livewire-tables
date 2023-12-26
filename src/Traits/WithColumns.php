<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Illuminate\Support\Collection;
use Rappasoft\LaravelLivewireTables\Exceptions\NoColumnsException;
use Rappasoft\LaravelLivewireTables\Traits\Configuration\ColumnConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Helpers\ColumnHelpers;

trait WithColumns
{
    use ColumnConfiguration;
    use ColumnHelpers;

    protected Collection $columns;

    protected Collection $prependedColumns;

    protected Collection $appendedColumns;

    protected ?bool $shouldAlwaysCollapse;

    protected ?bool $shouldMobileCollapse;

    protected ?bool $shouldTabletCollapse;

    public int $defaultVisibleColumnCount;

    public int $visibleColumnCount;

    /**
     * Sets up Columns
     */
    public function bootedWithColumns(): void
    {
        $this->columns = collect();

        // Sets Columns
        // Fire Lifecycle Hooks for settingColumns
        $this->callHook('settingColumns');
        $this->callTraitHook('settingColumns');

        // Set Columns
        $this->setColumns();

        // Fire Lifecycle Hooks for columnsSet
        $this->callHook('columnsSet');
        $this->callTraitHook('columnsSet');

        if ($this->columns->count() == 0) {
            throw new NoColumnsException('You must have defined a minimum of one Column for the table to function');
        }

    }

    /**
     * The array defining the columns of the table.
     */
    abstract public function columns(): array;

    /**
     * Prepend columns.
     */
    public function prependColumns(): array
    {
        return [];
    }

    /**
     * Append columns.
     */
    public function appendColumns(): array
    {
        return [];
    }

    /**
     * Add Columns to View
     */
    public function renderingWithColumns(\Illuminate\View\View $view, array $data = []): void
    {
        $view = $view->with([
            'columns' => $this->getColumns(),
        ]);
    }
}
