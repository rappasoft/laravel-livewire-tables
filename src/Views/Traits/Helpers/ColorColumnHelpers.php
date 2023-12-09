<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Helpers;

trait ColorColumnHelpers
{
    public function getView(): string
    {
        return $this->view;
    }

    // TODO: Test
    public function getColorCallback(): ?callable
    {
        return $this->colorCallback;
    }

    public function hasColorCallback(): bool
    {
        return $this->colorCallback !== null;
    }

    public function getAttributesCallback(): ?callable
    {
        return $this->attributesCallback;
    }

    public function hasAttributesCallback(): bool
    {
        return $this->attributesCallback !== null;
    }
}
