<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Configuration;

trait ViewComponentColumnConfiguration
{
    /**
     * Defines the View Component to be used for the Column
     */
    public function component(string $component): self
    {
        $this->componentView = $component;

        return $this;
    }

    public function customComponent(string $customComponentView): self
    {
        $this->customComponentView = $customComponentView;

        return $this;
    }
}
