<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Helpers;

trait LoadingPlaceholderHelpers
{
    public function hasDisplayLoadingPlaceholder(): bool
    {
        return $this->getDisplayLoadingPlaceholder();
    }

    public function getDisplayLoadingPlaceholder(): bool
    {
        return $this->displayLoadingPlaceholder;
    }

    public function getLoadingPlaceholderContent(): string
    {
        return $this->loadingPlaceholderContent ?? __('livewire-tables:loading');
    }

    public function getLoadingPlaceholderAttributes(): array
    {
        return count($this->loadingPlaceHolderAttributes) ? $this->loadingPlaceHolderAttributes : ['default' => true];

    }

    public function getLoadingPlaceholderTrAttributes(): array
    {
        return count($this->loadingPlaceHolderTrAttributes) ? $this->loadingPlaceHolderTrAttributes : ['default' => true];
    }

    public function getLoadingPlaceholderTdAttributes(): array
    {
        return count($this->loadingPlaceHolderTdAttributes) ? $this->loadingPlaceHolderTdAttributes : ['default' => true];
    }

    public function getLoadingPlaceHolderIconAttributes(): array
    {
        return count($this->loadingPlaceHolderIconAttributes) ? $this->loadingPlaceHolderIconAttributes : ['default' => true];
    }

    public function getLoadingPlaceHolderWrapperAttributes(): array
    {
        return count($this->loadingPlaceHolderTrAttributes) ? $this->loadingPlaceHolderTrAttributes : ['default' => true];
    }

    public function hasLoadingPlaceholderBlade(): bool
    {
        return ! is_null($this->getLoadingPlaceHolderBlade());
    }

    public function getLoadingPlaceHolderBlade(): ?string
    {
        return $this->loadingPlaceholderBlade;
    }

    public function hasLoadingPlaceholderContentBlade(): bool
    {
        return ! is_null($this->getLoadingPlaceHolderContentBlade());
    }

    public function getLoadingPlaceHolderContentBlade(): ?string
    {
        return $this->loadingPlaceholderContentBlade;
    }
}
