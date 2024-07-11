<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Core;

use Closure;
use Rappasoft\LaravelLivewireTables\Views\{Column,Filter};

trait HasConfirmation
{
    protected ?string $confirmMessage;

    public function confirmMessage(string $confirmMessage): self
    {
        $this->confirmMessage = $confirmMessage;

        return $this;
    }

    public function hasConfirmMessage(): bool
    {
        return isset($this->confirmMessage);
    }

    public function getConfirmMessage(): string
    {
        return $this->confirmMessage;
    }
}
