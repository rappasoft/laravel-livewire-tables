<?php

namespace Rappasoft\LaravelLivewireTables\Views\Filters\Traits;

trait HandlesClearButton
{
    protected bool $resetByClearButton = true;

    public function isResetByClearButton(): bool
    {
        return $this->resetByClearButton === true;
    }

    public function notResetByClearButton(): self
    {
        $this->resetByClearButton = false;

        return $this;
    }
}
