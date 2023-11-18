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

    public function hasSearchThrottle(): bool
    {
        return $this->searchFilterThrottle !== null;
    }

    public function getSearchThrottle(): ?int
    {
        return $this->searchFilterThrottle;
    }

    public function hasSearchBlur(): bool
    {
        return $this->searchFilterBlur !== null;
    }

    public function getSearchOptions(): string
    {
        if ($this->hasSearchDebounce()) {
            return '.live.debounce.'.$this->getSearchDebounce().'ms';
        }

        if ($this->hasSearchDefer()) {
            return '';
        }

        if ($this->hasSearchLive()) {
            return '.live';
        }

        if ($this->hasSearchBlur()) {
            return '.blur';
        }

        if ($this->hasSearchLazy()) {
            return '.live.lazy';
        }

        if ($this->hasSearchThrottle()) {
            return '.live.throttle.'.$this->getSearchThrottle().'ms';
        }

        return '.live';
    }

    public function getSearchPlaceholder(): string
    {
        return $this->hasSearchPlaceholder() ? $this->searchPlaceholder : __('Search');
    }

    public function hasSearchPlaceholder(): bool
    {
        return $this->searchPlaceholder !== null;
    }

    public function getSearchFieldAttributes(): array
    {
        return count($this->searchFieldAttributes) ? $this->searchFieldAttributes : ['default' => true];
    }
}
