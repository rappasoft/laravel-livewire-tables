<?php

namespace Rappasoft\LaravelLivewireTables\Views\Columns\Traits\Helpers;

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
