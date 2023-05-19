<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Configuration;

use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;

trait SearchConfiguration
{
    public function setSearch(string $query): self
    {
        $this->{$this->getTableName()}['search'] = $query;

        return $this;
    }

    public function setSearchStatus(bool $status): self
    {
        $this->searchStatus = $status;

        return $this;
    }

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

    public function setSearchVisibilityStatus(bool $status): self
    {
        $this->searchVisibilityStatus = $status;

        return $this;
    }

    public function setSearchVisibilityEnabled(): self
    {
        $this->setSearchVisibilityStatus(true);

        return $this;
    }

    public function setSearchVisibilityDisabled(): self
    {
        $this->setSearchVisibilityStatus(false);

        return $this;
    }

    /**
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
