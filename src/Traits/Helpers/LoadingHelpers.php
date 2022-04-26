<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Helpers;

trait LoadingHelpers
{
    /**
     * @return bool
     */
    public function loadingIsEnabled(): bool
    {
        return $this->loading !== false;
    }

    /**
     * @return bool|string
     */
    public function getLoadingStatus()
    {
        return $this->loading;
    }

    /**
     * @return bool
     */
    public function loadingDelayIsEnabled(): bool
    {
        return $this->loadingDelay !== false;
    }

    /**
     * @return bool|string
     */
    public function getLoadingDelayStatus()
    {
        return $this->loadingDelay;
    }

    /**
     * @return bool|string
     */
    public function hasLoadingDelayModifier()
    {
        return $this->loadingDelayModifier !== '';
    }

    /**
     * @return bool|string
     */
    public function getLoadingDelayModifier()
    {
        return $this->loadingDelayModifier;
    }
}
