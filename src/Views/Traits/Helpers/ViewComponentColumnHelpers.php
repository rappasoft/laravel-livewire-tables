<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Helpers;

trait ViewComponentColumnHelpers
{
    public function getComponentView(): string
    {
        return $this->componentView;
    }

    public function hasComponentView(): bool
    {
        return isset($this->componentView);
    }
}
