<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Helpers;

trait ConfigurableAreasHelpers
{
    /**
     * @return array<mixed>
     */
    public function getConfigurableAreas(): array
    {
        return $this->configurableAreas;
    }

    public function hasConfigurableAreaFor(string $area): bool
    {
        if ($this->hideConfigurableAreasWhenReorderingIsEnabled() && $this->reorderIsEnabled() && $this->currentlyReorderingIsEnabled()) {
            return false;
        }

        return isset($this->configurableAreas[$area]) && $this->getConfigurableAreaFor($area) !== null;
    }

    /**
     * @param  string|array<mixed>  $area
     */
    public function getConfigurableAreaFor($area): ?string
    {
        $area = $this->configurableAreas[$area] ?? null;

        if (is_array($area)) {
            return $area[0] ?? array_key_first($area);
        }

        return $area;
    }

    /**
     * @param  string|array<mixed>  $area
     * @return array<mixed>
     */
    public function getParametersForConfigurableArea($area): array
    {
        $area = $this->configurableAreas[$area] ?? null;

        if (is_array($area) && is_array($conditions = head($area))) {
            return $conditions;
        }

        return [];
    }

    public function getHideConfigurableAreasWhenReorderingStatus(): bool
    {
        return $this->hideConfigurableAreasWhenReorderingStatus;
    }

    public function hideConfigurableAreasWhenReorderingIsEnabled(): bool
    {
        return $this->getHideConfigurableAreasWhenReorderingStatus() === true;
    }

    public function hideConfigurableAreasWhenReorderingIsDisabled(): bool
    {
        return $this->getHideConfigurableAreasWhenReorderingStatus() === false;
    }
}
