<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Configuration;

use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;

trait SearchConfiguration
{
    /**
     * @param  string  $query
     *
     * @return self
     */
    public function setSearch(string $query): self
    {
        $this->{$this->getTableName()}['search'] = $query;

        return $this;
    }

    /**
     * @param  bool  $status
     *
     * @return self
     */
    public function setSearchStatus(bool $status): self
    {
        $this->searchStatus = $status;

        return $this;
    }

    /**
     * @return self
     */
    public function setSearchEnabled(): self
    {
        $this->setSearchStatus(true);

        return $this;
    }

    /**
     * @return $this
     */
    public function setSearchDisabled(): self
    {
        $this->setSearchStatus(false);

        return $this;
    }

    /**
     * @param  bool  $status
     *
     * @return self
     */
    public function setSearchVisibilityStatus(bool $status): self
    {
        $this->searchVisibilityStatus = $status;

        return $this;
    }

    /**
     * @return self
     */
    public function setSearchVisibilityEnabled(): self
    {
        $this->setSearchVisibilityStatus(true);

        return $this;
    }

    /**
     * @return self
     */
    public function setSearchVisibilityDisabled(): self
    {
        $this->setSearchVisibilityStatus(false);

        return $this;
    }

    /**
     * @param  int  $milliseconds
     *
     * @return self
     * @throws DataTableConfigurationException
     */
    public function setSearchDebounce(int $milliseconds): self
    {
        if ($this->hasSearchDefer() || $this->hasSearchLazy()) {
            throw new DataTableConfigurationException('You can only set one search filter option per table: debounce, defer, or lazy.');
        }

        $this->searchFilterDebounce = $milliseconds;

        return $this;
    }

    /**
     * @return self
     * @throws DataTableConfigurationException
     */
    public function setSearchDefer(): self
    {
        if ($this->hasSearchDebounce() || $this->hasSearchLazy()) {
            throw new DataTableConfigurationException('You can only set one search filter option per table: debounce, defer, or lazy.');
        }

        $this->searchFilterDefer = true;

        return $this;
    }

    /**
     * @return self
     * @throws DataTableConfigurationException
     */
    public function setSearchLazy(): self
    {
        if ($this->hasSearchDebounce() || $this->hasSearchDefer()) {
            throw new DataTableConfigurationException('You can only set one search filter option per table: debounce, defer, or lazy.');
        }

        $this->searchFilterLazy = true;

        return $this;
    }
}
