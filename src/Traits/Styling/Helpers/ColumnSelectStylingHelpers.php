<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Styling\Helpers;

use Illuminate\View\ComponentAttributeBag;
use Livewire\Attributes\Computed;

trait ColumnSelectStylingHelpers
{
    #[Computed]
    public function getColumnSelectButtonAttributes(): array
    {
        return $this->columnSelectButtonAttributes;
    }

    #[Computed]
    public function getColumnSelectMenuOptionCheckboxAttributes(): array
    {
        return $this->columnSelectMenuOptionCheckboxAttributes;
    }
}
