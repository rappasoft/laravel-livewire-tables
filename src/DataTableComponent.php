<?php

namespace Rappasoft\LaravelLivewireTables;

use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Traits\HasAllTraits;

abstract class DataTableComponent extends Component
{
    use HasAllTraits;

    /** @phpstan-ignore-next-line */
    protected $listeners = [
        'refreshDatatable' => '$refresh',
        'setSort' => 'setSortEvent',
        'clearSorts' => 'clearSortEvent',
        'setFilter' => 'setFilterEvent',
        'clearFilters' => 'clearFilterEvent',
    ];

    /**
     * Returns a unique id for the table, used as an alias to identify one table from another session and query string to prevent conflicts
     */
    protected function generateDataTableFingerprint(): string
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
        //
    }

    /**
     * Runs on every request, after the component is mounted or hydrated, but before any update methods are called
     */
    public function booted(): void
    {
        // Configuring
        // Fire hook for configuring
        $this->callHook('configuring');
        $this->callTraitHook('configuring');

        // Call the configure() method
        $this->configure();

        // Fire hook for configured
        $this->callHook('configured');
        $this->callTraitHook('configured');

        //Sets up the Builder Instance
        $this->setBuilder($this->builder());

        // Sets Columns
        // Fire hook for settingColumns
        $this->callHook('settingColumns');
        $this->callTraitHook('settingColumns');

        // Set Columns
        $this->setColumns();

        // Fire hook for columnsSet
        $this->callHook('columnsSet');
        $this->callTraitHook('columnsSet');

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
     */
    abstract public function columns(): array;

    /**
     * The base query - typically overridden in child components
     */
    public function builder(): Builder
    {
        if ($this->hasModel()) {
            return $this->getModel()::query()->with($this->getRelationships());
        }

        // If model does not exist
        throw new DataTableConfigurationException('You must either specify a model or implement the builder method.');
    }

    public function render(): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view('livewire-tables::datatable');
    }
}
