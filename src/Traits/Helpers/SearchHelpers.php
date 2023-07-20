<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Helpers;

trait SearchHelpers
{
    public function hasSearch(): bool
    {
        return $this->search != '';
    }

    public function getSearch(): string
    {
        return $this->search ?? '';
    }

    /**
     * Search the search query from the table array
     */
    public function clearSearch(): void
    {
        $this->search = '';
    }

    public function getSearchStatus(): bool
    {
        return $this->searchStatus;
    }

    public function searchIsEnabled(): bool
    {
        return $this->getSearchStatus() === true;
    }

    public function searchIsDisabled(): bool
    {
        return $this->getSearchStatus() === false;
    }

    public function getSearchVisibilityStatus(): bool
    {
        return $this->searchVisibilityStatus;
    }

    public function searchVisibilityIsEnabled(): bool
    {
        return $this->getSearchVisibilityStatus() === true;
    }

    public function searchVisibilityIsDisabled(): bool
    {
        return $this->getSearchVisibilityStatus() === false;
    }

    public function hasSearchDebounce(): bool
    {
        return $this->searchFilterDebounce !== null;
    }

    public function getSearchDebounce(): ?int
    {
        return $this->searchFilterDebounce;
    }

    public function hasSearchDefer(): bool
    {
        return $this->searchFilterDefer !== null;
    }

    public function hasSearchLazy(): bool
    {
        return $this->searchFilterLazy !== null;
    }

    public function hasSearchLive(): bool
    {
        return $this->searchFilterLive !== null;
    }

    public function getSearchOptions(): string
    {
        if ($this->hasSearchDebounce()) {
            return '.debounce.'.$this->getSearchDebounce().'ms';
        }

        if ($this->hasSearchDefer()) {
            return '';
        }

        if ($this->hasSearchLive()) {
            return '.live';
        }

        if ($this->hasSearchLazy()) {
            return '.lazy';
        }

        return '';
    }
}
