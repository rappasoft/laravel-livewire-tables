<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Styling\Helpers;

use Livewire\Attributes\Computed;

trait SortingPillsStylingHelpers
{
    #[Computed]
    public function getSortingPillsItemAttributes(): array
    {
        return $this->sortingPillsItemAttributes;
    }

    #[Computed]
    public function getSortingPillsClearSortButtonAttributes(): array
    {
        return $this->sortingPillsClearSortButtonAttributes;
    }

    #[Computed]
    public function getSortingPillsClearAllButtonAttributes(): array
    {
        return $this->sortingPillsClearAllButtonAttributes;
    }
}
