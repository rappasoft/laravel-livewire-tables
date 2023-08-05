<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Helpers;

trait ImageColumnHelpers
{
    // TODO: Test
    public function getLocationCallback(): ?callable
    {
        return $this->locationCallback;
    }

    public function hasLocationCallback(): bool
    {
        return $this->locationCallback !== null;
    }

    public function getAttributesCallback(): ?callable
    {
        return $this->attributesCallback;
    }

    public function hasAttributesCallback(): bool
    {
        return $this->attributesCallback !== null;
    }

    public function getView(): string
    {
        return $this->view;
    }
}
