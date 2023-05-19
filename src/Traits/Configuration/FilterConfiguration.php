<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Configuration;

use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;

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

    public function setFilterLayout(string $type): self
    {
        if (! in_array($type, ['popover', 'slide-down'], true)) {
            throw new DataTableConfigurationException('Invalid filter layout type');
        }

        $this->filterLayout = $type;

        return $this;
    }

    public function setFilterLayoutPopover(): self
    {
        $this->setFilterLayout('popover');

        return $this;
    }

    public function setFilterLayoutSlideDown(): self
    {
        $this->setFilterLayout('slide-down');

        return $this;
    }

    public function setFilterSlideDownDefaultStatus(bool $status): self
    {
        $this->filterSlideDownDefaultVisible = $status;

        return $this;
    }

    public function setFilterSlideDownDefaultStatusDisabled(): self
    {
        $this->setFilterSlideDownDefaultStatus(false);

        return $this;
    }

    public function setFilterSlideDownDefaultStatusEnabled(): self
    {
        $this->setFilterSlideDownDefaultStatus(true);

        return $this;
    }
}
