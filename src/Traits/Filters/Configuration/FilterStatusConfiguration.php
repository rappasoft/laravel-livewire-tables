<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Filters\Configuration;

trait FilterStatusConfiguration
{
    public function setFiltersStatus(bool $status): self
    {
        $this->filtersStatus = $status;

        return $this;
    }

    public function setFiltersEnabled(): self
    {
        return $this->setFiltersStatus(true);
    }

    public function setFiltersDisabled(): self
    {
        return $this->setFiltersStatus(false);
    }
}
