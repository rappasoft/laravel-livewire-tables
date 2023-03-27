<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Configuration;

trait SortingConfiguration
{
    /**
     * @param  bool  $status
     *
     * @return $this
     */
    public function setSortingStatus(bool $status): self
    {
        $this->sortingStatus = $status;

        return $this;
    }

    /**
     * @return $this
     */
    public function setSortingEnabled(): self
    {
        $this->setSortingStatus(true);

        return $this;
    }

    /**
     * @return $this
     */
    public function setSortingDisabled(): self
    {
        $this->setSortingStatus(false);

        return $this;
    }

    /**
     * @param  bool  $status
     *
     * @return $this
     */
    public function setSingleSortingStatus(bool $status): self
    {
        $this->singleColumnSortingStatus = $status;

        return $this;
    }

    /**
     * @return $this
     */
    public function setSingleSortingEnabled(): self
    {
        $this->setSingleSortingStatus(true);

        return $this;
    }

    /**
     * @return $this
     */
    public function setSingleSortingDisabled(): self
    {
        $this->setSingleSortingStatus(false);

        return $this;
    }

    /**
     * @param  string  $field
     * @param  string  $direction
     *
     * @return $this
     */
    public function setDefaultSort(string $field, string $direction = 'asc'): self
    {
        $this->defaultSortColumn = $field;
        $this->defaultSortDirection = $direction;

        return $this;
    }

    /**
     * @return $this
     */
    public function removeDefaultSort(): self
    {
        $this->defaultSortColumn = null;
        $this->defaultSortDirection = 'asc';

        return $this;
    }

    /**
     * @param  bool  $status
     *
     * @return $this
     */
    public function setSortingPillsStatus(bool $status): self
    {
        $this->sortingPillsStatus = $status;

        return $this;
    }

    /**
     * @return $this
     */
    public function setSortingPillsEnabled(): self
    {
        $this->setSortingPillsStatus(true);

        return $this;
    }

    /**
     * @return $this
     */
    public function setSortingPillsDisabled(): self
    {
        $this->setSortingPillsStatus(false);

        return $this;
    }

    /**
     * @param  string  $asc
     * @param  string  $desc
     *
     * @return $this
     */
    public function setDefaultSortingLabels(string $asc, string $desc): self
    {
        $this->defaultSortingLabelAsc = $asc;
        $this->defaultSortingLabelDesc = $desc;

        return $this;
    }
}
