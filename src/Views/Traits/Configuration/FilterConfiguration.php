<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Configuration;

use Rappasoft\LaravelLivewireTables\Views\Filter;

trait FilterConfiguration
{
    /**
     * @param  array<mixed>  $config
     */
    public function config(array $config = []): Filter
    {
        $this->config = $config;

        return $this;
    }

    public function setFilterPillTitle(string $title): self
    {
        $this->filterPillTitle = $title;

        return $this;
    }

    /**
     * @param  array<mixed>  $values
     */
    public function setFilterPillValues(array $values): self
    {
        $this->filterPillValues = $values;

        return $this;
    }

    public function hiddenFromMenus(): self
    {
        $this->hiddenFromMenus = true;

        return $this;
    }

    public function hiddenFromPills(): self
    {
        $this->hiddenFromPills = true;

        return $this;
    }

    public function hiddenFromFilterCount(): self
    {
        $this->hiddenFromFilterCount = true;

        return $this;
    }

    public function hiddenFromAll(): self
    {
        $this->hiddenFromMenus = true;
        $this->hiddenFromPills = true;
        $this->hiddenFromFilterCount = true;

        return $this;
    }

    public function notResetByClearButton(): self
    {
        $this->resetByClearButton = false;

        return $this;
    }

    public function setFilterPosition(string $position): self
    {
        $this->filterPosition = $position;

        return $this;
    }

    public function setCustomFilterLabel(string $filterCustomLabel): self
    {
        $this->filterCustomLabel = $filterCustomLabel;

        return $this;
    }

    public function setFilterSlidedownRow(string $filterSlidedownRow): self
    {
        //$this->filterSlidedownRow = (is_int($filterSlidedownRow) ? $filterSlidedownRow : intval($filterSlidedownRow));
        $this->filterSlidedownRow = intval($filterSlidedownRow);

        return $this;
    }

    public function setFilterSlidedownColspan(string $filterSlidedownColspan): self
    {
        //$this->filterSlidedownColspan = (is_int($filterSlidedownColspan) ? $filterSlidedownColspan : intval($filterSlidedownColspan));
        $this->filterSlidedownColspan = intval($filterSlidedownColspan);

        return $this;
    }

    public function setFilterPillBlade(string $blade): self
    {
        $this->filterCustomPillBlade = $blade;

        return $this;
    }

    /**
     * Sets a Default Value via the Filter Component
     *
     * @param  mixed  $value
     */
    public function setFilterDefaultValue($value): self
    {
        $this->filterDefaultValue = $value;

        return $this;
    }
}
