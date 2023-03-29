<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Configuration;

use Rappasoft\LaravelLivewireTables\Views\Filter;

trait FilterConfiguration
{
    /**
     * @param string $key
     * @param mixed  $value
     *
     * @return $this
     */
    public function config(array $config = []): Filter
    {
        $this->config = $config;

        return $this;
    }

    /**
     * @param string $key
     *
     * @return $this
     */
    public function setFilterPillTitle(string $title): self
    {
        $this->filterPillTitle = $title;

        return $this;
    }

    /**
     * @param string $key
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

    /**
     * @param string $position
     *
     * @return $this
     */
    public function setFilterPosition(string $position): self
    {
        $this->filterPosition = $position;

        return $this;
    }
     
     /**
    * @param string $filterCustomLabel
    *
    * @return $this
    */
    public function setCustomFilterLabel(string $filterCustomLabel): self
    {
        $this->filterCustomLabel = $filterCustomLabel;

        return $this;
    }
    
    /**
     * @param string|int $filterSlidedownRow
     *
     * @return $this
     */
    public function setFilterSlidedownRow(string|int $filterSlidedownRow): self
    {
        $this->filterSlidedownRow = (is_int($filterSlidedownRow) ? $filterSlidedownRow : intval($filterSlidedownRow));

        return $this;
    }

    /**
     * @param string|int $filterSlidedownColspan
     *
     * @return $this
     */
    public function setFilterSlidedownColspan(string|int $filterSlidedownColspan): self
    {
        $this->filterSlidedownColspan = (is_int($filterSlidedownColspan) ? $filterSlidedownColspan : intval($filterSlidedownColspan));
        
        return $this;
    }
    
    /**
     * @param string $blade
     *
     * @return $this
     */
    public function setFilterPillBlade(string $blade): self
    {
        $this->filterCustomPillBlade = $blade;

        return $this;
    }
}
