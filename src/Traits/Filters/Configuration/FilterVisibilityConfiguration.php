<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Filters\Configuration;

trait FilterVisibilityConfiguration
{
    public function setFiltersVisibilityStatus(bool $status): self
    {
        $this->filtersVisibilityStatus = $status;

        return $this;
    }

    public function setFiltersVisibilityEnabled(): self
    {
        return $this->setFiltersVisibilityStatus(true);
    }

    public function setFiltersVisibilityDisabled(): self
    {
        return $this->setFiltersVisibilityStatus(false);
    }
}
