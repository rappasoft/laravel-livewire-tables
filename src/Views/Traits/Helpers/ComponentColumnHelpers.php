<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Helpers;

trait ComponentColumnHelpers
{
    public function getSlotCallback(): ?callable
    {
        return $this->slotCallback;
    }

    public function hasSlotCallback(): bool
    {
        return $this->slotCallback !== null;
    }

    public function getComponentView(): string
    {
        return $this->componentView;
    }

    public function hasComponentView(): bool
    {
        return isset($this->componentView);
    }
}
