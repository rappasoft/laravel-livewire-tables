<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Core\Component;

trait HandlesComputedProperties
{
    protected bool $useComputedProperties = true;

    protected function setComputedPropertiesStatus(bool $useComputedProperties): self
    {
        $this->useComputedProperties = $useComputedProperties;

        return $this;
    }

    public function useComputedPropertiesEnabled(): self
    {
        return $this->setComputedPropertiesStatus(true);
    }

    public function useComputedPropertiesDisabled(): self
    {
        return $this->setComputedPropertiesStatus(false);
    }

    public function getComputedPropertiesStatus(): bool
    {
        return $this->useComputedProperties ?? false;
    }
}
