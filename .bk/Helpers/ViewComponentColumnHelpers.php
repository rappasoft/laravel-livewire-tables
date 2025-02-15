<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Helpers;

trait ViewComponentColumnHelpers
{
    public function hasCustomComponent(): bool
    {
        return isset($this->customComponentView);
    }

    public function getCustomComponent(): string
    {
        return $this->customComponentView;
    }
}
