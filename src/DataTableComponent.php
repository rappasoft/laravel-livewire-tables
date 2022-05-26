<?php

namespace Rappasoft\LaravelLivewireTables;

use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Traits\ComponentUtilities;
use Rappasoft\LaravelLivewireTables\Traits\WithBulkActions;
use Rappasoft\LaravelLivewireTables\Traits\WithColumns;
use Rappasoft\LaravelLivewireTables\Traits\WithColumnSelect;
use Rappasoft\LaravelLivewireTables\Traits\WithData;
use Rappasoft\LaravelLivewireTables\Traits\WithDebugging;
use Rappasoft\LaravelLivewireTables\Traits\WithEvents;
use Rappasoft\LaravelLivewireTables\Traits\WithFilters;
use Rappasoft\LaravelLivewireTables\Traits\WithFooter;
use Rappasoft\LaravelLivewireTables\Traits\WithPagination;
use Rappasoft\LaravelLivewireTables\Traits\WithRefresh;
use Rappasoft\LaravelLivewireTables\Traits\WithReordering;
use Rappasoft\LaravelLivewireTables\Traits\WithSearch;
use Rappasoft\LaravelLivewireTables\Traits\WithSecondaryHeader;
use Rappasoft\LaravelLivewireTables\Traits\WithSorting;

abstract class DataTableComponent extends Component
{
    use ComponentUtilities,
        WithBulkActions,
        WithColumns,
        WithColumnSelect,
        WithData,
        WithDebugging,
        WithEvents,
        WithFilters,
        WithFooter,
        WithSecondaryHeader,
        WithPagination,
        WithRefresh,
        WithReordering,
        WithSearch,
        WithSorting;

    protected $listeners = [
        'refreshDatatable' => '$refresh',
        'setSort' => 'setSortEvent',
        'clearSorts' => 'clearSortEvent',
        'setFilter' => 'setFilterEvent',
        'clearFilters' => 'clearFilterEvent',
    ];

    /**
     * returns a unique id for the table, used as an alias to identify one table from another session and query string to prevent conflicts
     */
    protected function dataTableFingerprint(): string
    {
        $className = str_split(static::class);
        $crc32 = sprintf('%u', crc32(serialize($className)));

        return base_convert($crc32, 10, 36);
    }

    /**
     * Runs on every request, immediately after the component is instantiated, but before any other lifecycle methods are called
     */
    public function boot(): void
    {
        $this->{$this->tableName} = [
            'sorts' => $this->{$this->tableName}['sorts'] ?? [],
            'filters' => $this->{$this->tableName}['filters'] ?? [],
            'columns' => $this->{$this->tableName}['columns'] ?? [],
        ];
        
        // Set the filter defaults based on the filter type
        $this->setFilterDefaults();
    }

    /**
     * Runs on every request, after the component is mounted or hydrated, but before any update methods are called
     */
    public function booted(): void
    {
        $this->configure();
        $this->setTheme();
        $this->setBuilder($this->builder());
        $this->setColumns();

        // Make sure a primary key is set
        if (! $this->hasPrimaryKey()) {
            throw new DataTableConfigurationException('You must set a primary key using setPrimaryKey in the configure method.');
        }
    }

    /**
     * Set any configuration options
     */
    abstract public function configure(): void;

    /**
     * The array defining the columns of the table.
     *
     * @return array
     */
    abstract public function columns(): array;

    /**
     * The base query.
     */
    public function builder(): Builder
    {
        if ($this->hasModel()) {
            return $this->getModel()::query();
        }

        throw new DataTableConfigurationException('You must either specify a model or implement the builder method.');
    }

    /**
     * The view to add any modals for the table, could also be used for any non-visible html
     *
     * @return string
     */
    public function customView(): string
    {
        return 'livewire-tables::stubs.custom';
    }
    
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        $this->setupColumnSelect();
        $this->setupPagination();
        $this->setupSecondaryHeader();
        $this->setupFooter();
        $this->setupReordering();

        return view('livewire-tables::datatable')
            ->with([
                'columns' => $this->getColumns(),
                'rows' => $this->getRows(),
                'customView' => $this->customView(),
            ]);
    }
}
