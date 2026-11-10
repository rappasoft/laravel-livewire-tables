<?php

namespace Rappasoft\LaravelLivewireTables;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Rappasoft\LaravelLivewireTables\Traits\HasAllTraits;

abstract class DataTableComponent extends Component
{
    use HasAllTraits;

    /**
     * Runs on every request, immediately after the component is instantiated, but before any other lifecycle methods are called
     * Called when refreshDatatable is called as an event
     */
    #[On('refreshDatatable')]
    public function boot(): void
    {
        //
    }

    /**
     * Runs on every request, after the component is mounted or hydrated, but before any update methods are called
     */
    public function booted(): void {}

    /**
     * The package methods the browser may call. Everything else this package defines is
     * configuration and is refused, see Features\GuardBrowserCalls. Methods defined by the
     * application itself are unaffected. Override to extend:
     * return [...parent::browserCallableMethods(), 'setPerPage'];
     *
     * @return array<int, string>
     */
    public function browserCallableMethods(): array
    {
        return [
            'sortBy', 'setSort', 'clearSort', 'clearSorts',
            'setSearch', 'clearSearch',
            'setFilter', 'resetFilter', 'setFilterDefaults', 'selectAllFilterOptions',
            'selectAllColumns', 'deselectAllColumns',
            'setAllSelected', 'clearSelected',
            'enableReordering', 'disableReordering', 'storeReorder',
        ];
    }

    public function render(): Application|Factory|View
    {
        return view('livewire-tables::datatable');
    }

    /**
     * Livewire's default lazy placeholder is a bare <div>, which Alpine initialises
     * before the real table is morphed in, so every x-show/x-bind in the table then
     * throws a ReferenceError. Carrying the fallback scope avoids that.
     * Override this to render a skeleton instead.
     */
    public function placeholder(): string
    {
        return '<div x-data="'.$this->getAlpineFallbackScope().'"></div>';
    }
}
