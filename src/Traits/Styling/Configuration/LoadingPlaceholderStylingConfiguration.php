<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Styling\Configuration;

trait LoadingPlaceholderStylingConfiguration
{
    public function setLoadingPlaceHolderAttributes(array $attributes): self
    {
        $this->loadingPlaceHolderAttributes = $attributes;

        return $this;
    }

    public function setLoadingPlaceHolderIconAttributes(array $attributes): self
    {
        $this->loadingPlaceHolderIconAttributes = $attributes;

        return $this;
    }

    public function setLoadingPlaceHolderWrapperAttributes(array $attributes): self
    {
        $this->loadingPlaceHolderWrapperAttributes = $attributes;

        return $this;
    }

    public function setLoadingPlaceholderBlade(string $customBlade): self
    {
        $this->loadingPlaceholderBlade = $customBlade;

        return $this;
    }
}
