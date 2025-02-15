<?php

namespace Rappasoft\LaravelLivewireTables\Views\Columns\Traits;

trait HasVisibility
{
    protected bool $hidden = false;

    public function isVisible(): bool
    {
        return $this->hidden !== true;
    }

    public function isHidden(): bool
    {
        return $this->hidden === true;
    }

    public function hideIf(mixed $condition): self
    {
        $this->hidden = $condition;

        return $this;
    }
}
