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
use Rappasoft\LaravelLivewireTables\Traits\WithFilters;
use Rappasoft\LaravelLivewireTables\Traits\WithFooter;
use Rappasoft\LaravelLivewireTables\Traits\WithPagination;
use Rappasoft\LaravelLivewireTables\Traits\WithRefresh;
use Rappasoft\LaravelLivewireTables\Traits\WithReordering;
use Rappasoft\LaravelLivewireTables\Traits\WithSearch;
use Rappasoft\LaravelLivewireTables\Traits\WithSecondaryHeader;
use Rappasoft\LaravelLivewireTables\Traits\WithSorting;
use Rappasoft\LaravelLivewireTables\Traits\WithLoading;

abstract class DataTableComponent extends Component
{
    use ComponentUtilities,
        WithBulkActions,
        WithColumns,
        WithColumnSelect,
        WithData,
        WithDebugging,
        WithFilters,
        WithFooter,
        WithSecondaryHeader,
        WithPagination,
        WithRefresh,
        WithReordering,
        WithSearch,
        WithSorting,
        WithLoading;

    protected $listeners = ['refreshDatatable' => '$refresh'];

    /**
     * Runs on every request, immediately after the component is instantiated, but before any other lifecycle methods are called
     */
    public function boot(): void
    {
        $this->{$this->tableName} = [
            'sorts' => $this->{$this->tableName}['sorts'] ?? [],
            'filters' => $this->{$this->tableName}['filters'] ?? [],
        ];

        // Set the filter defaults based on the filter type
        $this->setFilterDefaults();
        
        // Set the user defined columns to work with
        $this->setColumns();

        // Call the child configuration, if any
        $this->configure();

        // Make sure a primary key is set
        if (! $this->hasPrimaryKey()) {
            throw new DataTableConfigurationException('You must set a primary key using setPrimaryKey in the configure method.');
        }
    }

    /**
     * Runs on every request, after the component is mounted or hydrated, but before any update methods are called
     */
    public function booted(): void
    {
        $this->setTheme();
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
        return view('livewire-tables::datatable')
            ->with([
                'columns' => $this->getColumns(),
                'rows' => $this->getRows(),
                'customView' => $this->customView(),
            ]);
    }
}
