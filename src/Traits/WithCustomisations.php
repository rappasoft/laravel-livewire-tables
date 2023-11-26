<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Rappasoft\LaravelLivewireTables\Traits\Configuration\CustomisationsConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Helpers\CustomisationsHelpers;

trait WithCustomisations
{
    use CustomisationsConfiguration,
        CustomisationsHelpers;

    /**
     * The view to add any modals for the table, could also be used for any non-visible html
     */
    public function customView(): string
    {
        return 'livewire-tables::stubs.custom';
    }

    /** 
     * Add customView to the View
     */
    public function renderingWithCustomisations($view, $data): void
    {
        $view = $view->with([
            'customView' => $this->customView(),
        ]);
    }
}
