<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Illuminate\Support\Collection;
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

    public array $columnSelectStats2;

    public int $defaultVisibleColumnCount;

    public int $visibleColumnCount;

    /**
     * Sets up Columns
     */
    public function bootWithColumns(): void
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

    }

    /**
     * Prepend columns.
     */
    public function prependColumns()
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

    public function renderingWithColumns($view, $data)
    {
        $view = $view->with([
            'columns' => $this->getColumns(),
        ]);
    }
}
