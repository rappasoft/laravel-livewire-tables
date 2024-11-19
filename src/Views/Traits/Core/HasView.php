<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Core;

use Illuminate\Support\Facades\Log;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Views\{Column,Filter};

trait HasView
{
    protected function bootedHasView(): void
    {
        if (! property_exists($this, 'view') || ! isset($this->view) || $this->view == null) {
            throw new DataTableConfigurationException('No View Defined');
        }
    }

    public function getView(): string
    {
        return $this->view;
    }

    public function getColumnView()
    {
        return view($this->getView());
    }

    public function getColumnViewWithDefaults()
    {
        return $this->getColumnView()
            ->withIsTailwind($this->isTailwind())
            ->withIsBootstrap($this->isBootstrap())
            ->withLocalisationPath($this->getLocalisationPath());

    }

    /**
     * @return $this
     */
    public function setView(string $view): self
    {
        $this->view = $view;

        return $this;
    }

    public function setCustomView(string $customView): self
    {
        $this->setView($customView);

        return $this;
    }

    public function getViewPath(): string
    {
        return $this->view ?? '';
    }
}
