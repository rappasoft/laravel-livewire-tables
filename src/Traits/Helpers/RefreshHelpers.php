<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Helpers;

trait RefreshHelpers
{
    /**
     * @return bool
     */
    public function hasRefresh(): bool
    {
        return $this->refresh !== false;
    }

    /**
     * @return bool|string
     */
    public function getRefreshStatus()
    {
        return $this->refresh;
    }

    /**
     * @return string|null
     */
    public function getRefreshOptions(): ?string
    {
        if ($this->hasRefresh()) {
            if (is_numeric($this->getRefreshStatus())) {
                return '.' . $this->getRefreshStatus().'ms';
            }

            switch ($this->getRefreshStatus()) {
                case 'keep-alive':
                    return '.keep-alive';
                case 'visible':
                    return '.visible';
                default:
                    return '=' . $this->getRefreshStatus();
            }
        }

        return null;
    }
}
