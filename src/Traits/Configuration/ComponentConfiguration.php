<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Configuration;

trait ComponentConfiguration
{
    /**
     * Set the empty message
     */
    public function setEmptyMessage(string $message): self
    {
        $this->emptyMessage = $message;

        return $this;
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

    public function setDataTableFingerprint(string $dataTableFingerprint): self
    {
        $this->dataTableFingerprint = $dataTableFingerprint;

        return $this;
    }

    public function useComputedPropertiesEnabled(): self
    {
        $this->useComputedProperties = true;

        return $this;
    }

    public function useComputedPropertiesDisabled(): self
    {
        $this->useComputedProperties = false;

        return $this;
    }
}
