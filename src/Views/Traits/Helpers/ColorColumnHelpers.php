<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Helpers;

trait ColorColumnHelpers
{
    /**
     * Retrieve the Column Classes to use for the Column
     */
    public function getCustomClasses(): array
    {
        return $this->customClasses ?? ['class' => '', 'default' => false];
    }

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
}
