<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Styling\Helpers;

use Livewire\Attributes\Computed;

trait LoadingPlaceholderStylingHelpers
{
    public function getLoadingPlaceholderAttributes(): array
    {
        return count($this->loadingPlaceHolderAttributes) ? $this->loadingPlaceHolderAttributes : ['default' => true];
    }

    public function getLoadingPlaceHolderIconAttributes(): array
    {
        return count($this->loadingPlaceHolderIconAttributes) ? $this->loadingPlaceHolderIconAttributes : ['default' => true];
    }

    public function getLoadingPlaceHolderWrapperAttributes(): array
    {
        return count($this->loadingPlaceHolderWrapperAttributes) ? $this->loadingPlaceHolderWrapperAttributes : ['default' => true];
    }

    public function getLoadingPlaceHolderCellAttributes(): array
    {
        return count($this->loadingPlaceHolderCellAttributes) ? $this->loadingPlaceHolderCellAttributes : ['default' => true];
    }
}
