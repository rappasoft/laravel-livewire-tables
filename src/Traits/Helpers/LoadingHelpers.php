<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Helpers;

trait LoadingHelpers
{
    public function hasDisplayLoadingPlaceholder(): bool
    {
        return $this->getDisplayLoadingPlaceholder();
    }

    public function getDisplayLoadingPlaceholder(): bool
    {
        return $this->displayLoadingPlaceholder;
    }

    public function hasLoadingPlaceholderContent(): bool
    {
        return !is_null($this->getLoadingPlaceholderContent());
    }

    public function getLoadingPlaceholderContent(): string
    {
        return $this->loadingPlaceholderContent;
    }


    public function hasLoadingPlaceholderAttributes(): bool
    {
        return !empty($this->getLoadingPlaceholderAttributes());
    }

    public function getLoadingPlaceholderAttributes(): array
    {
        return $this->loadingPlaceHolderAttributes;
    }

    public function hasPlaceHolderIconAttributes(): bool
    {
        return !empty($this->getPlaceHolderIconAttributes());
    }

    public function getPlaceHolderIconAttributes(): array
    {
        return $this->loadingPlaceHolderIconAttributes;
    }
}
