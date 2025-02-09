<?php

namespace Rappasoft\LaravelLivewireTables\Views\Filters\Traits\Pills;

trait HandlesPillsCustomBlade
{
    protected ?string $filterCustomPillBlade = null;

    public function setFilterPillBlade(string $blade): self
    {
        $this->filterCustomPillBlade = $blade;

        return $this;
    }

    /**
     * Determine if filter has a Custom Pill Blade
     */
    public function hasCustomPillBlade(): bool
    {
        return $this->filterCustomPillBlade != null;
    }

    /**
     * Get the path to the Custom Pill Blade
     */
    public function getCustomPillBlade(): ?string
    {
        return $this->filterCustomPillBlade;
    }
}
