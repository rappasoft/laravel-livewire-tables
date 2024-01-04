<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Core;

use Closure;
use Rappasoft\LaravelLivewireTables\Views\{Column,Filter};

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
