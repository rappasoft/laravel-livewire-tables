<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Core\Search;

use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;

trait HandlesSearchModifiers
{
    protected ?bool $searchFilterBlur = null;

    protected ?int $searchFilterDebounce = null;

    protected ?bool $searchFilterDefer = null;

    protected ?bool $searchFilterLazy = null;

    protected ?bool $searchFilterLive = null;

    protected ?int $searchFilterThrottle = null;

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

    /**
     * @throws DataTableConfigurationException
     */
    public function setSearchDebounce(int $milliseconds): self
    {
        if ($this->hasSearchBlur() || $this->hasSearchDefer() || $this->hasSearchLazy() || $this->hasSearchLive() || $this->hasSearchThrottle()) {
            throw new DataTableConfigurationException('You can only set one search filter option per table: live, blur, throttle, debounce, defer, or lazy.');
        }

        $this->searchFilterDebounce = $milliseconds;

        return $this;
    }

    /**
     * @throws DataTableConfigurationException
     */
    public function setSearchDefer(): self
    {
        if ($this->hasSearchBlur() || $this->hasSearchDebounce() || $this->hasSearchLazy() || $this->hasSearchLive() || $this->hasSearchThrottle()) {
            throw new DataTableConfigurationException('You can only set one search filter option per table: live, blur, throttle, debounce, defer, or lazy.');
        }

        $this->searchFilterDefer = true;

        return $this;
    }

    /**
     * @throws DataTableConfigurationException
     */
    public function setSearchLive(): self
    {
        if ($this->hasSearchBlur() || $this->hasSearchDebounce() || $this->hasSearchDefer() || $this->hasSearchLazy() || $this->hasSearchThrottle()) {
            throw new DataTableConfigurationException('You can only set one search filter option per table: live, blur, throttle, debounce, defer, or lazy.');
        }

        $this->searchFilterLive = true;

        return $this;
    }

    /**
     * @throws DataTableConfigurationException
     */
    public function setSearchThrottle(int $milliseconds): self
    {
        if ($this->hasSearchBlur() || $this->hasSearchDebounce() || $this->hasSearchDefer() || $this->hasSearchLazy() || $this->hasSearchLive()) {
            throw new DataTableConfigurationException('You can only set one search filter option per table: live, blur, throttle, debounce, defer, or lazy.');
        }

        $this->searchFilterThrottle = $milliseconds;

        return $this;
    }

    /**
     * @throws DataTableConfigurationException
     */
    public function setSearchBlur(): self
    {
        if ($this->hasSearchDebounce() || $this->hasSearchDefer() || $this->hasSearchLazy() || $this->hasSearchLive() || $this->hasSearchThrottle()) {
            throw new DataTableConfigurationException('You can only set one search filter option per table: live, blur, throttle, debounce, defer, or lazy.');
        }

        $this->searchFilterBlur = true;

        return $this;
    }

    /**
     * @throws DataTableConfigurationException
     */
    public function setSearchLazy(): self
    {
        if ($this->hasSearchBlur() || $this->hasSearchDebounce() || $this->hasSearchDefer() || $this->hasSearchLive() || $this->hasSearchThrottle()) {
            throw new DataTableConfigurationException('You can only set one search filter option per table: live, blur, throttle, debounce, defer, or lazy.');
        }

        $this->searchFilterLazy = true;

        return $this;
    }
}
