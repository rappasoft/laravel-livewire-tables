<?php

declare(strict_types=1);

namespace Rappasoft\LaravelLivewireTables;

use Closure;
use Livewire\Attributes\On;
use Livewire\Component;
use Rappasoft\LaravelLivewireTables\Traits\HasAllTraits;

/**
 * Base DataTable component class
 *
 * Extend this class to create powerful, feature-rich data tables with:
 * - Sorting, filtering, searching
 * - Pagination (standard, simple, cursor)
 * - Bulk actions
 * - Column selection
 * - Row reordering
 * - Summaries
 * - Row grouping
 * - And much more...
 *
 * @method void configure() Set component configuration
 * @method \Illuminate\Database\Eloquent\Builder builder() Define the query builder
 * @method array columns() Define table columns
 */
abstract class DataTableComponent extends Component
{
    use HasAllTraits;

    /**
     * Global configuration callback applied to all table instances
     */
    protected static ?Closure $globalConfigurationCallback = null;

    /**
     * Configure defaults for all DataTableComponent instances
     *
     * Usage in AppServiceProvider::boot():
     * ```php
     * DataTableComponent::configureUsing(function (DataTableComponent $component) {
     *     $component->setPerPageAccepted([10, 25, 50, 100]);
     *     $component->setLoadingPlaceholderEnabled();
     * });
     * ```
     */
    public static function configureUsing(Closure $callback): void
    {
        static::$globalConfigurationCallback = $callback;
    }

    /**
     * Reset the global configuration callback
     */
    public static function flushGlobalConfiguration(): void
    {
        static::$globalConfigurationCallback = null;
    }

    /**
     * Apply global configuration if set
     */
    protected function applyGlobalConfiguration(): void
    {
        if (static::$globalConfigurationCallback !== null) {
            (static::$globalConfigurationCallback)($this);
        }
    }

    /**
     * Livewire boot hook - runs on every request
     */
    #[On('refreshDatatable')]
    public function boot(): void
    {
        // Override in child class if needed
    }

    /**
     * Livewire booted hook - runs after mount or hydrate
     */
    public function booted(): void
    {
        // Override in child class if needed
    }

    /**
     * Render the datatable view
     */
    public function render(): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $view = view('livewire-tables::datatable');

        // Call rendering hooks for each feature
        $this->callRenderingHooks($view);

        return $view;
    }

    /**
     * Call all rendering hooks
     */
    protected function callRenderingHooks(\Illuminate\Contracts\View\View $view): void
    {
        $hooks = [
            'renderingWithCustomisations',
            'renderingWithColumns',
            'renderingWithColumnSelect',
            'renderingWithData',
            'renderingWithPagination',
            'renderingWithReordering',
            'renderingWithFooter',
            'renderingWithSummaries',
        ];

        foreach ($hooks as $hook) {
            $this->callHook($hook, [$view, []]);
        }
    }
}
