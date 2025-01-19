<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Filters\Styling\Helper;

use Livewire\Attributes\Computed;

trait FilterPillsStylingHelpers
{
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
