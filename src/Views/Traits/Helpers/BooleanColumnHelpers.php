<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Helpers;

use Closure;

trait BooleanColumnHelpers
{
    public function hasCallback(): bool
    {
        return $this->callback !== null;
    }

    public function getCallback(): Closure
    {
        return $this->callback;
    }

    public function getSuccessValue(): bool
    {
        return $this->successValue;
    }

    public function getView(): string
    {
        return $this->view;
    }

    public function getType(): string
    {
        return $this->type;
    }
}
