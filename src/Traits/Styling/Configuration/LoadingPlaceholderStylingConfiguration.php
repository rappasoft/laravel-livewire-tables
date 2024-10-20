<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Styling\Configuration;

trait LoadingPlaceholderStylingConfiguration
{
    public function setLoadingPlaceHolderAttributes(array $attributes): self
    {
        $this->setCustomAttributes('loadingPlaceHolderAttributes', [...$this->getCustomAttributes(propertyName: 'loadingPlaceHolderAttributes', default: false, classicMode: true), ...$attributes]);
       
        return $this;
    }

    public function setLoadingPlaceHolderIconAttributes(array $attributes): self
    {
        $this->setCustomAttributes('loadingPlaceHolderIconAttributes', [...$this->getCustomAttributes(propertyName: 'loadingPlaceHolderIconAttributes', default: false, classicMode: true), ...$attributes]);

        return $this;
    }

    public function setLoadingPlaceHolderWrapperAttributes(array $attributes): self
    {
        $this->setCustomAttributes('loadingPlaceHolderWrapperAttributes', [...$this->getCustomAttributes(propertyName: 'loadingPlaceHolderWrapperAttributes', default: false, classicMode: true), ...$attributes]);

        return $this;
    }
}
