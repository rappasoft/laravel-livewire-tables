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

    public function getLoadingPlaceholderContent(): string
    {
        return $this->loadingPlaceholderContent ?? __('livewire-tables:loading');
    }

    public function getLoadingPlaceholderAttributes(): array
    {
        return $this->loadingPlaceHolderAttributes;
    }

    public function getLoadingPlaceHolderIconAttributes(): array
    {
        return $this->loadingPlaceHolderIconAttributes ?? ['default' => true];
    }

    public function getLoadingPlaceHolderWrapperAttributes(): array
    {
        return $this->loadingPlaceHolderWrapperAttributes ?? ['default' => true];
    }

    public function hasLoadingPlaceholderBlade(): bool
    {
        return ! is_null($this->getLoadingPlaceHolderBlade());
    }

    public function getLoadingPlaceHolderBlade(): ?string
    {
        return $this->loadingPlaceholderBlade;
    }
}
