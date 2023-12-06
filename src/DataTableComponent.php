<?php

namespace Rappasoft\LaravelLivewireTables;

use Livewire\Component;
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
    }

    public function render(): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view('livewire-tables::datatable');
    }
}
