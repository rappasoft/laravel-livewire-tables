<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Core;

trait HasActionCallback
{
    protected mixed $actionCallback = null;

    public function action(callable $callback): self
    {
        $this->actionCallback = $callback;

        return $this;
    }

    public function getActionCallback(): ?callable
    {
        return $this->actionCallback;
    }

    public function hasActionCallback(): bool
    {
        return $this->actionCallback !== null;
    }
}
