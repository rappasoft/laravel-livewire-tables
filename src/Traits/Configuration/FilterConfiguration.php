<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Configuration;

trait FilterConfiguration
{
    public function setFiltersStatus(bool $status): self
    {
        $this->filtersStatus = $status;

        return $this;
    }

    public function setFiltersEnabled(): self
    {
        $this->setFiltersStatus(true);

        return $this;
    }

    public function setFiltersDisabled(): self
    {
        $this->setFiltersStatus(false);

        return $this;
    }


}
