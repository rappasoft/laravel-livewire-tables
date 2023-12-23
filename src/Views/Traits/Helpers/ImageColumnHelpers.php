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
}
