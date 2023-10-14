<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Helpers;

trait LoadingHelpers
{
    public function hasDisplayLoadingPlaceholder(): bool
    {
        return $this->displayLoadingPlaceholder;
    }

    public function getDisplayLoadingPlaceholder(): bool
    {
        return $this->displayLoadingPlaceholder;
    }

    public function hasLoadingPlaceholderAttributes(): bool
    {
        return !empty($this->loadingPlaceHolderAttributes);
    }

    public function getLoadingPlaceholderAttributes(): array
    {
        return $this->loadingPlaceHolderAttributes;
    }
    
    public function hasPlaceHolderIconAttributes(): bool
    {
        return !empty($this->loadingPlaceHolderIconAttributes);
    }

    public function getPlaceHolderIconAttributes(): array
    {
        return $this->loadingPlaceHolderIconAttributes;
    }

}