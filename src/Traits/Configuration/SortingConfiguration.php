<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Configuration;

trait SortingConfiguration
{
    /**
     * @param  bool  $status
     *
     * @return self
     */
    public function setSortingStatus(bool $status): self
    {
        $this->sortingStatus = $status;

        return $this;
    }

    /**
     * @return self
     */
    public function setSortingEnabled(): self
    {
        $this->setSortingStatus(true);

        return $this;
    }

    /**
     * @return self
     */
    public function setSortingDisabled(): self
    {
        $this->setSortingStatus(false);

        return $this;
    }

    /**
     * @param  bool  $status
     *
     * @return self
     */
    public function setSingleSortingStatus(bool $status): self
    {
        $this->singleColumnSortingStatus = $status;

        return $this;
    }

    /**
     * @return self
     */
    public function setSingleSortingEnabled(): self
    {
        $this->setSingleSortingStatus(true);

        return $this;
    }

    /**
     * @return self
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
     * @return self
     */
    public function setDefaultSort(string $field, string $direction = 'asc'): self
    {
        $this->defaultSortColumn = $field;
        $this->defaultSortDirection = $direction;

        return $this;
    }

    /**
     * @return self
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
     * @return self
     */
    public function setSortingPillsStatus(bool $status): self
    {
        $this->sortingPillsStatus = $status;

        return $this;
    }

    /**
     * @return self
     */
    public function setSortingPillsEnabled(): self
    {
        $this->setSortingPillsStatus(true);

        return $this;
    }

    /**
     * @return self
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
     * @return self
     */
    public function setDefaultSortingLabels(string $asc, string $desc): self
    {
        $this->defaultSortingLabelAsc = $asc;
        $this->defaultSortingLabelDesc = $desc;

        return $this;
    }
}
