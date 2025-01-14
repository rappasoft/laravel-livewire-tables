<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Livewire\Attributes\Locked;
use Rappasoft\LaravelLivewireTables\Events\ColumnsSelected;
use Rappasoft\LaravelLivewireTables\Traits\Configuration\ColumnSelectConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Core\QueryStrings\HasQueryStringForColumnSelect;
use Rappasoft\LaravelLivewireTables\Traits\Helpers\ColumnSelectHelpers;
use Rappasoft\LaravelLivewireTables\Traits\Styling\HasColumnSelectStyling;

trait WithColumnSelect
{
    use ColumnSelectConfiguration,
        ColumnSelectHelpers,
        HasQueryStringForColumnSelect,
        HasColumnSelectStyling;

    #[Locked]
    public array $columnSelectColumns = ['setupRun' => false, 'selected' => [], 'deselected' => [], 'defaultdeselected' => []];

    public array $selectedColumns = [];

    public array $deselectedColumns = [];

    public array $selectableColumns = [];

    public array $defaultDeselectedColumns = [];

    #[Locked]
    public bool $excludeDeselectedColumnsFromQuery = false;

    #[Locked]
    public bool $defaultDeselectedColumnsSetup = false;

    protected bool $columnSelectStatus = true;

    protected bool $columnSelectHiddenOnMobile = false;

    protected bool $columnSelectHiddenOnTablet = false;

    /*protected function queryStringWithColumnSelect(): array
    {
        if ($this->queryStringIsEnabled() && $this->columnSelectIsEnabled()) {
            return [
                'columns' => ['except' => null, 'history' => false, 'keep' => false, 'as' => $this->getQueryStringAlias().'-columns'],
            ];
        }

        return [];
    }*/

    public function bootedWithColumnSelect(): void
    {
        $this->callHook('configuringColumnSelect');
        $this->callTraitHook('configuringColumnSelect');

        $this->setupColumnSelect();

        $this->callHook('configuredColumnSelect');
        $this->callTraitHook('configuredColumnSelect');

    }

    public function updatedSelectedColumns(): void
    {
        // The query string isn't needed if it's the same as the default
        $this->storeColumnSelectValues();
        if ($this->getEventStatusColumnSelect()) {
            event(new ColumnsSelected($this->getTableName(), $this->getColumnSelectSessionKey(), $this->selectedColumns));
        }
    }

    public function renderingWithColumnSelect(\Illuminate\View\View $view, array $data = []): void
    {
        if (! $this->getComputedPropertiesStatus()) {
            $view->with([
                'selectedVisibleColumns' => $this->selectedVisibleColumns(),
            ]);
        }
    }
}
