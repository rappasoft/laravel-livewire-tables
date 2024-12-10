<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Columns;

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

    /**
     * @param  mixed  $condition
     */
    public function hideIf($condition): self
    {
        $this->hidden = $condition;

        return $this;
    }
}
