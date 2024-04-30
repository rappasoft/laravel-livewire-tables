<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Configuration;

trait ConfigurableAreasConfiguration
{
    /**
     * @param  array<mixed>  $areas
     */
    public function setConfigurableAreas(array $areas): self
    {
        $this->configurableAreas = $areas;

        return $this;
    }

    public function setConfigurableArea(string $configurableArea, mixed $config): self
    {
        if (array_key_exists($configurableArea, $this->configurableAreas)) {
            $this->configurableAreas[$configurableArea] = $config;
        }

        return $this;
    }

    public function setHideConfigurableAreasWhenReorderingStatus(bool $status): self
    {
        $this->hideConfigurableAreasWhenReorderingStatus = $status;

        return $this;
    }

    public function setHideConfigurableAreasWhenReorderingEnabled(): self
    {
        $this->setHideConfigurableAreasWhenReorderingStatus(true);

        return $this;
    }

    public function setHideConfigurableAreasWhenReorderingDisabled(): self
    {
        $this->setHideConfigurableAreasWhenReorderingStatus(false);

        return $this;
    }
}
