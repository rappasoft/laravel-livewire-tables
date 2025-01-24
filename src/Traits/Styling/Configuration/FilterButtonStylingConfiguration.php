<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Styling\Configuration;

trait FilterButtonStylingConfiguration
{
    public function setFilterButtonAttributes(array $attributes = []): self
    {
        $this->filterButtonAttributes = [...$this->filterButtonAttributes, ...$attributes];

        return $this;
    }

    public function setFilterButtonBadgeAttributes(array $attributes = []): self
    {
        $this->filterButtonBadgeAttributes = [...$this->filterButtonBadgeAttributes, ...$attributes];

        return $this;
    }
}
