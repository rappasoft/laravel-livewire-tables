<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Styling\Configuration;

trait FilterPillsStylingConfiguration
{
    public function setFilterPillsItemAttributes(array $attributes = []): self
    {
        $this->filterPillsItemAttributes = [...$this->filterPillsItemAttributes, ...$attributes];

        return $this;
    }

    public function setFilterPillsResetFilterButtonAttributes(array $attributes = []): self
    {
        $this->filterPillsResetFilterButtonAttributes = [...$this->filterPillsResetFilterButtonAttributes, ...$attributes];

        return $this;
    }

    public function setFilterPillsResetAllButtonAttributes(array $attributes = []): self
    {
        $this->filterPillsResetAllButtonAttributes = [...$this->filterPillsResetAllButtonAttributes, ...$attributes];

        return $this;
    }
}
