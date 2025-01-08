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
        return $this->setSearchStatus(true);
    }

    /**
     * @return $this
     */
    public function setSearchDisabled(): self
    {
        $this->search = '';

        return $this->setSearchStatus(false);
    }
}