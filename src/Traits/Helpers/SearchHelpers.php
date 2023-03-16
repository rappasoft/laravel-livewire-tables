<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Helpers;

trait SearchHelpers
{
    /**
     * @return bool
     */
    public function hasSearch(): bool
    {
        return ($this->{$this->getTableName()}['search'] ?? null) !== null;
    }

    /**
     * @return string|null
     */
    public function getSearch(): ?string
    {
        return $this->{$this->getTableName()}['search'] ?? null;
    }

    /**
     * Search the search query from the table array
     */
    public function clearSearch(): void
    {
        $this->{$this->getTableName()}['search'] = null;
    }

    /**
     * @return bool
     */
    public function getSearchStatus(): bool
    {
        return $this->searchStatus;
    }

    /**
     * @return bool
     */
    public function searchIsEnabled(): bool
    {
        return $this->getSearchStatus() === true;
    }

    /**
     * @return bool
     */
    public function searchIsDisabled(): bool
    {
        return $this->getSearchStatus() === false;
    }

    /**
     * @return bool
     */
    public function getSearchVisibilityStatus(): bool
    {
        return $this->searchVisibilityStatus;
    }

    /**
     * @return bool
     */
    public function searchVisibilityIsEnabled(): bool
    {
        return $this->getSearchVisibilityStatus() === true;
    }

    /**
     * @return bool
     */
    public function searchVisibilityIsDisabled(): bool
    {
        return $this->getSearchVisibilityStatus() === false;
    }

    /**
     * @return bool
     */
    public function hasSearchDebounce(): bool
    {
        return $this->searchFilterDebounce !== null;
    }

    /**
     * @return int|null
     */
    public function getSearchDebounce(): ?int
    {
        return $this->searchFilterDebounce;
    }

    /**
     * @return bool
     */
    public function hasSearchDefer(): bool
    {
        return $this->searchFilterDefer !== null;
    }

    /**
     * @return bool
     */
    public function hasSearchLazy(): bool
    {
        return $this->searchFilterLazy !== null;
    }

    /**
     * @return string
     */
    public function getSearchOptions(): string
    {
        if ($this->hasSearchDebounce()) {
            return '.debounce.' . $this->getSearchDebounce() . 'ms';
        }

        if ($this->hasSearchDefer()) {
            return '.defer';
        }

        if ($this->hasSearchLazy()) {
            return '.lazy';
        }

        return '';
    }
}
