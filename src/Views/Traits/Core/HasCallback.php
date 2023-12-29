<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Core;

use Closure;
use Rappasoft\LaravelLivewireTables\Views\{Column,Filter};

trait HasCallback
{
    protected ?Closure $callback = null;

    public function hasCallback(): bool
    {
        return $this->callback !== null;
    }

    public function getCallback(): ?Closure
    {
        return $this->callback;
    }

    /**
     * @return $this
     */
    public function setCallback(Closure $callback): self
    {
        $this->callback = $callback;

        return $this;
    }
}
