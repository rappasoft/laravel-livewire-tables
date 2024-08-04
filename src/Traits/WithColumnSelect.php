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

    public function updatedSelectedColumns(): void
    {
        // The query string isn't needed if it's the same as the default
        session([$this->getColumnSelectSessionKey() => $this->selectedColumns]);
        if ($this->getEventStatusColumnSelect()) {
            event(new ColumnsSelected($this->getTableName(), $this->getColumnSelectSessionKey(), $this->selectedColumns));
        }
    }

    public function renderingWithColumnSelect(\Illuminate\View\View $view, array $data = []): void
    {
        $view = $view->with([
            'selectedVisibleColumns' => $this->getVisibleColumns(),
        ]);
    }
}
