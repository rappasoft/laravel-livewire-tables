<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Configuration;

use Rappasoft\LaravelLivewireTables\Views\Filter;

trait FilterConfiguration
{
    /**
     * @param array<mixed> $config
     *
     * @return Filter
     */
    public function config(array $config = []): Filter
    {
        $this->config = $config;

        return $this;
    }

    /**
     * @param string $title
     *
     * @return self
     */
    public function setFilterPillTitle(string $title): self
    {
        $this->filterPillTitle = $title;

        return $this;
    }

    /**
     * @param array<mixed> $values
     *
     * @return self
     */
    public function setFilterPillValues(array $values): self
    {
        $this->filterPillValues = $values;

        return $this;
    }

    /**
     * @return self
     */
    public function hiddenFromMenus(): self
    {
        $this->hiddenFromMenus = true;

        return $this;
    }

    /**
     * @return self
     */
    public function hiddenFromPills(): self
    {
        $this->hiddenFromPills = true;

        return $this;
    }

    /**
     * @return self
     */
    public function hiddenFromFilterCount(): self
    {
        $this->hiddenFromFilterCount = true;

        return $this;
    }

    /**
     * @return self
     */
    public function hiddenFromAll(): self
    {
        $this->hiddenFromMenus = true;
        $this->hiddenFromPills = true;
        $this->hiddenFromFilterCount = true;

        return $this;
    }

    /**
     * @return self
     */
    public function notResetByClearButton(): self
    {
        $this->resetByClearButton = false;

        return $this;
    }

    /**
     * @param string $position
     *
     * @return self
     */
    public function setFilterPosition(string $position): self
    {
        $this->filterPosition = $position;

        return $this;
    }
     
    /**
     * @param string $filterCustomLabel
     *
     * @return self
     */
    public function setCustomFilterLabel(string $filterCustomLabel): self
    {
        $this->filterCustomLabel = $filterCustomLabel;

        return $this;
    }
    
    /**
     * @param string|int $filterSlidedownRow
     *
     * @return self
     */
    public function setFilterSlidedownRow(string|int $filterSlidedownRow): self
    {
        $this->filterSlidedownRow = (is_int($filterSlidedownRow) ? $filterSlidedownRow : intval($filterSlidedownRow));

        return $this;
    }

    /**
     * @param string|int $filterSlidedownColspan
     *
     * @return self
     */
    public function setFilterSlidedownColspan(string|int $filterSlidedownColspan): self
    {
        $this->filterSlidedownColspan = (is_int($filterSlidedownColspan) ? $filterSlidedownColspan : intval($filterSlidedownColspan));
        
        return $this;
    }
    
    /**
     * @param string $blade
     *
     * @return self
     */
    public function setFilterPillBlade(string $blade): self
    {
        $this->filterCustomPillBlade = $blade;

        return $this;
    }
}
