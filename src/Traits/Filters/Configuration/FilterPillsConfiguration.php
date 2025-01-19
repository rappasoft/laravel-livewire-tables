<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Filters\Configuration;

trait FilterPillsConfiguration
{
    public function setFilterPillsStatus(bool $status): self
    {
        $this->filterPillsStatus = $status;

        return $this;
    }

    public function setFilterPillsEnabled(): self
    {
        return $this->setFilterPillsStatus(true);
    }

    public function setFilterPillsDisabled(): self
    {
        return $this->setFilterPillsStatus(false);
    }
}
