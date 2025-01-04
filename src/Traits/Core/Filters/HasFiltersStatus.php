<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Core\Filters;

use Livewire\Attributes\Locked;

trait HasFiltersStatus
{
    #[Locked]
    public bool $filtersStatus = true;

    public function getFiltersStatus(): bool
    {
        return $this->filtersStatus;
    }

    public function filtersAreEnabled(): bool
    {
        return $this->getFiltersStatus() === true;
    }

    public function filtersAreDisabled(): bool
    {
        return $this->getFiltersStatus() === false;
    }

    protected function setFiltersStatus(bool $status): self
    {
        $this->filtersStatus = $status;

        return $this;
    }

    protected function setFiltersEnabled(): self
    {
        $this->setFiltersStatus(true);

        return $this;
    }

    protected function setFiltersDisabled(): self
    {
        $this->setFiltersStatus(false);

        return $this;
    }
}
