<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Styling\Helpers;

use Livewire\Attributes\Computed;

trait FilterButtonStylingHelpers
{
    #[Computed]
    public function getFilterButtonAttributes(): array
    {
        return $this->filterButtonAttributes;
    }

    #[Computed]
    public function getFilterButtonBadgeAttributes(): array
    {
        return $this->filterButtonBadgeAttributes;
    }
}
