<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Helpers;

trait DebugHelpers
{
    /**
     * @return bool
     */
    public function getDebugStatus(): bool
    {
        return $this->debugStatus;
    }

    /**
     * @return bool
     */
    public function debugIsEnabled(): bool
    {
        return $this->getDebugStatus() === true;
    }

    /**
     * @return bool
     */
    public function debugIsDisabled(): bool
    {
        return $this->getDebugStatus() === false;
    }
}
