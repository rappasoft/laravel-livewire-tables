<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Core;

trait HasLocationCallback
{
    protected mixed $locationCallback = null;

    public function location(callable $callback): self
    {
        $this->locationCallback = $callback;

        return $this;
    }

    public function getLocationCallback(): ?callable
    {
        return $this->locationCallback;
    }

    public function hasLocationCallback(): bool
    {
        return $this->locationCallback !== null;
    }
}
