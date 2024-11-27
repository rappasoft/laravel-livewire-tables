<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Styling\Helpers;

use Livewire\Attributes\Computed;

trait SearchFieldStylingHelpers
{

    public function getSearchFieldAttributes(): array
    {
        return $this->getCustomAttributes('searchFieldAttributes', true);
    }

    #[Computed]
    public function hasSearchIcon(): bool
    {
        return $this->searchIconSet;
    }

    #[Computed]
    public function getSearchIcon(): string
    {
        return $this->hasSearchIcon() ? $this->searchIcon : 'heroicon-m-magnifying-glass';
    }

    #[Computed]
    public function getSearchIconAttributes(): array
    {
        return $this->getCustomAttributes('searchIconAttributes', true, false);
    }

}