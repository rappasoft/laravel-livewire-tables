<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Filters\Helpers;

use Livewire\Attributes\Computed;

trait FilterStatusHelpers
{
    public function getFiltersStatus(): bool
    {
        return $this->filtersStatus;
    }

    #[Computed]
    public function filtersAreEnabled(): bool
    {
        return $this->getFiltersStatus() === true;
    }

    public function filtersAreDisabled(): bool
    {
        return $this->getFiltersStatus() === false;
    }
}
