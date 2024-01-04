<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Filters;

use Rappasoft\LaravelLivewireTables\Views\{Column,Filter};

trait HasCustomPosition
{
    public ?string $filterPosition = null;

    protected ?int $filterSlidedownRow = null;

    protected ?int $filterSlidedownColspan = null;

    /**
     * Determines whether this filter instance is in the secondary header/footer
     */
    public function hasCustomPosition(): bool
    {
        return ! is_null($this->filterPosition);
    }

    /**
     * Returns the custom position of the footer (header or footer)
     */
    public function getCustomPosition(): string
    {
        return $this->filterPosition;
    }

    public function setFilterPosition(string $position): self
    {
        $this->filterPosition = $position;

        return $this;
    }

    /**
     * Get the filter slide down row.
     */
    public function getFilterSlidedownRow(): ?int
    {
        return $this->filterSlidedownRow;
    }

    /**
     * Get whether the filter has a configured slide down row.
     */
    public function hasFilterSlidedownRow(): bool
    {
        return ! is_null($this->filterSlidedownRow);
    }

    /**
     * Get the filter slide down col span.
     */
    public function getFilterSlidedownColspan(): ?int
    {
        return $this->filterSlidedownColspan;
    }

    /**
     * Get whether the filter has a configured slide down colspan.
     */
    public function hasFilterSlidedownColspan(): bool
    {
        return ! is_null($this->filterSlidedownColspan);
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
}
