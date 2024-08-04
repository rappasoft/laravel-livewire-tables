<?php

namespace Rappasoft\LaravelLivewireTables;

use Livewire\Component;
use Rappasoft\LaravelLivewireTables\Traits\HasAllTraits;
use Livewire\Attributes\On;

abstract class DataTableComponent extends Component
{
    use HasAllTraits;

    /**
     * Runs on every request, immediately after the component is instantiated, but before any other lifecycle methods are called
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

    public function render(): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view('livewire-tables::datatable');
    }
}
