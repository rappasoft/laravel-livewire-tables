<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Core\Component;

trait HandlesOfflineIndicator
{
    protected bool $offlineIndicatorStatus = true;

    public function getOfflineIndicatorStatus(): bool
    {
        return $this->offlineIndicatorStatus;
    }

    public function offlineIndicatorIsEnabled(): bool
    {
        return $this->getOfflineIndicatorStatus() === true;
    }

    public function offlineIndicatorIsDisabled(): bool
    {
        return $this->getOfflineIndicatorStatus() === false;
    }

    public function setOfflineIndicatorStatus(bool $status): self
    {
        $this->offlineIndicatorStatus = $status;

        return $this;
    }

    public function setOfflineIndicatorEnabled(): self
    {
        $this->setOfflineIndicatorStatus(true);

        return $this;
    }

    public function setOfflineIndicatorDisabled(): self
    {
        $this->setOfflineIndicatorStatus(false);

        return $this;
    }
}
