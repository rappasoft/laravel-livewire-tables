<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Configuration;

use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;

trait FilterConfiguration
{
    /**
     * @param  bool  $status
     *
     * @return self
     */
    public function setFiltersStatus(bool $status): self
    {
        $this->filtersStatus = $status;

        return $this;
    }

    /**
     * @return self
     */
    public function setFiltersEnabled(): self
    {
        $this->setFiltersStatus(true);

        return $this;
    }

    /**
     * @return self
     */
    public function setFiltersDisabled(): self
    {
        $this->setFiltersStatus(false);

        return $this;
    }

    /**
     * @param  bool $status
     *
     * @return self
     */
    public function setFiltersVisibilityStatus(bool $status): self
    {
        $this->filtersVisibilityStatus = $status;

        return $this;
    }

    /**
     * @return self
     */
    public function setFiltersVisibilityEnabled(): self
    {
        $this->setFiltersVisibilityStatus(true);

        return $this;
    }

    /**
     * @return self
     */
    public function setFiltersVisibilityDisabled(): self
    {
        $this->setFiltersVisibilityStatus(false);

        return $this;
    }

    /**
     * @param  bool $status
     *
     * @return self
     */
    public function setFilterPillsStatus(bool $status): self
    {
        $this->filterPillsStatus = $status;

        return $this;
    }

    /**
     * @return self
     */
    public function setFilterPillsEnabled(): self
    {
        $this->setFilterPillsStatus(true);

        return $this;
    }

    /**
     * @return self
     */
    public function setFilterPillsDisabled(): self
    {
        $this->setFilterPillsStatus(false);

        return $this;
    }

    /**
     * @param string $type
     *
     * @return self
     */
    public function setFilterLayout(string $type): self
    {
        if (! in_array($type, ['popover', 'slide-down'], true)) {
            throw new DataTableConfigurationException('Invalid filter layout type');
        }

        $this->filterLayout = $type;

        return $this;
    }

    /**
     * @return self
     */
    public function setFilterLayoutPopover(): self
    {
        $this->setFilterLayout('popover');

        return $this;
    }

    /**
     * @return self
     */
    public function setFilterLayoutSlideDown(): self
    {
        $this->setFilterLayout('slide-down');

        return $this;
    }

    /**
     * @param  bool $status
     *
     * @return self
     */
    public function setFilterSlideDownDefaultStatus(bool $status): self
    {
        $this->filterSlideDownDefaultVisible = $status;

        return $this;
    }

    /**
     * @return self
     */
    public function setFilterSlideDownDefaultStatusDisabled(): self
    {
        $this->setFilterSlideDownDefaultStatus(false);

        return $this;
    }

    /**
     * @return self
     */
    public function setFilterSlideDownDefaultStatusEnabled(): self
    {
        $this->setFilterSlideDownDefaultStatus(true);

        return $this;
    }
}
