<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Helpers;

trait ViewComponentColumnHelpers
{
    /**
     * Retrieves the defined Component View
     */
    public function getComponentView(): string
    {
        return $this->componentView;
    }

    /**
     * Determines whether a Component View has been set
     */
    public function hasComponentView(): bool
    {
        return isset($this->componentView);
    }

    public function hasCustomComponent(): bool
    {
        return isset($this->customComponentView);
    }

    public function getCustomComponent(): string
    {
        return $this->customComponentView;
    }
}
