<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Configuration;

use Rappasoft\LaravelLivewireTables\DataTransferObjects\FilterGenericData;

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

    public function setFiltersVisibilityStatus(bool $status): self
    {
        $this->filtersVisibilityStatus = $status;

        return $this;
    }

    public function setFiltersVisibilityEnabled(): self
    {
        $this->setFiltersVisibilityStatus(true);

        return $this;
    }

    public function setFiltersVisibilityDisabled(): self
    {
        $this->setFiltersVisibilityStatus(false);

        return $this;
    }

    public function setFilterPillsStatus(bool $status): self
    {
        $this->filterPillsStatus = $status;

        return $this;
    }

    public function setFilterPillsEnabled(): self
    {
        $this->setFilterPillsStatus(true);

        return $this;
    }

    public function setFilterPillsDisabled(): self
    {
        $this->setFilterPillsStatus(false);

        return $this;
    }

    public function generateFilterGenericData(): array
    {
        return (new FilterGenericData($this->getTableName(), $this->getFilterLayout(), $this->isTailwind(), $this->isBootstrap4(), $this->isBootstrap5()))->toArray();
    }

    public function setFilterGenericData(array $filterGenericData = []): void
    {
        $this->filterGenericData = $filterGenericData;
    }
}
