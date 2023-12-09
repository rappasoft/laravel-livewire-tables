<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Helpers;

use Illuminate\View\ComponentAttributeBag;

trait ColorColumnHelpers
{
    // TODO: Test
    protected function getView(): string
    {
        return $this->view;
    }

    // TODO: Test
    protected function getColor($row): string
    {
        return $this->hasColorCallback() ? app()->call($this->getColorCallback(), ['row' => $row]) : $this->getValue($row);
    }

    // TODO: Test
    protected function getAttributeBag($row)
    {
        return new ComponentAttributeBag($this->hasAttributesCallback() ? app()->call($this->getAttributesCallback(), ['row' => $row]) : []);
    }

    protected function getColorCallback(): ?callable
    {
        return $this->colorCallback;
    }

    protected function hasColorCallback(): bool
    {
        return $this->colorCallback !== null;
    }

    // TODO: Test
    protected function getAttributesCallback(): ?callable
    {
        return $this->attributesCallback;
    }

    protected function hasAttributesCallback(): bool
    {
        return $this->attributesCallback !== null;
    }
}
