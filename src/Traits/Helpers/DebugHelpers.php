<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Helpers;

trait DebugHelpers
{
    public function getDebugStatus(): bool
    {
        return $this->debugStatus;
    }

    public function debugIsEnabled(): bool
    {
        return $this->getDebugStatus() === true;
    }

    public function debugIsDisabled(): bool
    {
        return $this->getDebugStatus() === false;
    }
}
