<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Helpers;

trait ComponentColumnHelpers
{
    public function getAttributesCallback()
    {
        return $this->attributesCallback;
    }

    public function hasAttributesCallback(): bool
    {
        return $this->attributesCallback !== null;
    }

    public function getSlotCallback()
    {
        return $this->slotCallback;
    }

    public function hasSlotCallback(): bool
    {
        return $this->slotCallback !== null;
    }

    /**
     * Get the value of componentView
     */
    public function getComponentView()
    {
        return $this->componentView;
    }

    public function hasComponentView(): bool
    {
        return isset($this->componentView);
    }
}
