<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Styling\Helpers;

use Livewire\Attributes\Computed;

trait LoadingPlaceholderStylingHelpers
{
    public function getLoadingPlaceholderAttributes(): array
    {
        return $this->getCustomAttributes(propertyName: 'loadingPlaceHolderAttributes', default: true, classicMode: true);

    }

    public function getLoadingPlaceHolderIconAttributes(): array
    {
        return $this->getCustomAttributes(propertyName: 'loadingPlaceHolderIconAttributes', default: true, classicMode: true);

    }

    public function getLoadingPlaceHolderWrapperAttributes(): array
    {
        return $this->getCustomAttributes(propertyName: 'loadingPlaceHolderWrapperAttributes', default: true, classicMode: true);

    }

    public function getLoadingPlaceHolderCellAttributes(): array
    {
        return $this->getCustomAttributes(propertyName: 'loadingPlaceHolderCellAttributes', default: true, classicMode: true);

    }

}
