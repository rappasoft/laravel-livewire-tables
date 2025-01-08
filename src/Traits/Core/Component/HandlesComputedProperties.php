<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Core\Component;

trait HandlesComputedProperties
{
    protected bool $useComputedProperties = true;

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
    
    public function getComputedPropertiesStatus(): bool
    {
        return $this->useComputedProperties ?? false;
    }
}