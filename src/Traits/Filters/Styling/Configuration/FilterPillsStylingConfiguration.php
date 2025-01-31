<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Filters\Styling\Configuration;

trait FilterPillsStylingConfiguration
{
    protected function setShowFilterPillsWhileLoading(bool $status): self
    {
        $this->showFilterPillsWhileLoading = $status;

        return $this;
    }

    protected function showFilterPillsWhileLoadingEnabled(): self
    {
        return $this->setShowFilterPillsWhileLoading(true);
    }

    protected function showFilterPillsWhileLoadingDisabled(): self
    {
        return $this->setShowFilterPillsWhileLoading(false);
    }

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
