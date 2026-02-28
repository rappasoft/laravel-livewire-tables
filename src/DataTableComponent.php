<?php

namespace Rappasoft\LaravelLivewireTables;

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

    public function render(): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view('livewire-tables::datatable');
    }

    /**
     * Returns a placeholder view for Livewire lazy loading support.
     * Uses the configured lazy placeholder view if set, otherwise falls back to the default.
     * Override this method in your table component to provide a fully custom placeholder.
     *
     * @param  array<string, mixed>  $params
     */
    public function placeholder(array $params = []): \Illuminate\Contracts\View\View
    {
        $content = null;

        if ($this->hasLazyPlaceholderEnabled()) {
            $content = $this->hasLazyPlaceholderView()
                ? $this->getLazyPlaceholderView()
                : 'livewire-tables::lazy-placeholder-content';
        }

        return view('livewire-tables::lazy-placeholder', [
            'lazyPlaceholderContent' => $content,
            'isTailwind' => $this->isTailwind,
            'isBootstrap' => $this->isBootstrap,
            'isBootstrap4' => $this->isBootstrap4,
            'isBootstrap5' => $this->isBootstrap5,
        ]);
    }
}
