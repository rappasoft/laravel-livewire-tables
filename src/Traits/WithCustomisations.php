<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Rappasoft\LaravelLivewireTables\Traits\Configuration\CustomisationsConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Helpers\CustomisationsHelpers;

trait WithCustomisations
{
    use CustomisationsConfiguration,
        CustomisationsHelpers;

    protected ?string $layout = null;

    protected ?string $slot = null;

    protected ?string $extends = null;

    protected ?string $section = null;

    public function renderingWithCustomisations(\Illuminate\View\View $view, array $data = []): void
    {
        if ($this->hasLayout()) {
            $view->layout($this->getLayout());
        }

        if ($this->hasExtends()) {
            $view->extends($this->getExtends());
        }

        if ($this->hasSection()) {
            $view->section($this->getSection());
        }

        if ($this->hasSlot()) {
            $view->slot($this->getSlot());
        }

        $view = $view->with([
            'customView' => method_exists($this, 'customView') ? $this->customView() : '',
        ]);

    }
}
