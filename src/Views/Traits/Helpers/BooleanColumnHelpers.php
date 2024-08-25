<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Helpers;

use Closure;

trait BooleanColumnHelpers
{
    public function getSuccessValue(): bool
    {
        return $this->successValue;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getIsToggleable(): bool
    {
        return $this->isToggleable ?? false;
    }

    public function getToggleMethod(): ?string
    {
        return $this->toggleMethod ?? null;
    }
}
