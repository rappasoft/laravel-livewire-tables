<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Filters\Styling\Helpers;

use Livewire\Attributes\Computed;

trait FilterPillsStylingHelpers
{
    #[Computed]
    public function displayFilterPillsWhileLoading(): bool
    {
        return $this->showFilterPillsWhileLoading;
    }

    #[Computed]
    public function getFilterPillsItemAttributes(): array
    {
        return $this->filterPillsItemAttributes;
    }

    #[Computed]
    public function getFilterPillsResetFilterButtonAttributes(): array
    {
        return $this->filterPillsResetFilterButtonAttributes;
    }

    #[Computed]
    public function getFilterPillsResetAllButtonAttributes(): array
    {
        return $this->filterPillsResetAllButtonAttributes;
    }
}
