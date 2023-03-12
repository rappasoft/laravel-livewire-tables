<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Configuration;

use Rappasoft\LaravelLivewireTables\Views\Filter;

trait FilterConfiguration
{
    /**
     * @param array<mixed> $config
     *
     * @return $this
     */
    public function config(array $config = []): Filter
    {
        $this->config = $config;

        return $this;
    }

    /**
     * @param string $title
     *
     * @return $this
     */
    public function setFilterPillTitle(string $title): self
    {
        $this->filterPillTitle = $title;

        return $this;
    }

    /**
     * @param string $filterSlidedownRow
     *
     * @return $this
     */
    public function setFilterSlidedownRow(string $filterSlidedownRow): self
    {
        $this->filterSlidedownRow = $filterSlidedownRow;

        return $this;
    }

    /**
     * @param string $filterSlidedownColspan
     *
     * @return $this
     */
    public function setFilterSlidedownColspan(string $filterSlidedownColspan): self
    {
        $this->filterSlidedownColspan = $filterSlidedownColspan;

        return $this;
    }


    /**
     * @param array<mixed> $values
     *
     * @return $this
     */
    public function setFilterPillValues(array $values): self
    {
        $this->filterPillValues = $values;

        return $this;
    }

    /**
     * @return $this
     */
    public function hiddenFromMenus(): self
    {
        $this->hiddenFromMenus = true;

        return $this;
    }

    /**
     * @return $this
     */
    public function hiddenFromPills(): self
    {
        $this->hiddenFromPills = true;

        return $this;
    }

    /**
     * @return $this
     */
    public function hiddenFromFilterCount(): self
    {
        $this->hiddenFromFilterCount = true;

        return $this;
    }

    /**
     * @return $this
     */
    public function hiddenFromAll(): self
    {
        $this->hiddenFromMenus = true;
        $this->hiddenFromPills = true;
        $this->hiddenFromFilterCount = true;

        return $this;
    }

    /**
     * @return $this
     */
    public function notResetByClearButton(): self
    {
        $this->resetByClearButton = false;

        return $this;
    }
}
