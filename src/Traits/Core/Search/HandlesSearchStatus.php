<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Core\Search;

use Livewire\Attributes\{Computed, Locked};

trait HandlesSearchStatus
{
    #[Locked]
    public bool $searchStatus = true;

    public function getSearchStatus(): bool
    {
        return $this->searchStatus;
    }

    #[Computed]
    public function showSearchField(): bool
    {
        return $this->searchIsEnabled() && $this->searchVisibilityIsEnabled();
    }

    #[Computed]
    public function searchIsEnabled(): bool
    {
        return $this->getSearchStatus() === true;
    }

    public function searchIsDisabled(): bool
    {
        return $this->getSearchStatus() === false;
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
        $this->search = '';

        $this->setSearchStatus(false);

        return $this;
    }
}
