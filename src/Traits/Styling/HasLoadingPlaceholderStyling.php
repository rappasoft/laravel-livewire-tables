<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Styling;

trait HasLoadingPlaceholderStyling
{
    protected array $loadingPlaceHolderAttributes = [];

    protected array $loadingPlaceHolderIconAttributes = [];

    protected array $loadingPlaceHolderWrapperAttributes = [];

    protected array $loadingPlaceHolderRowAttributes = [];

    protected array $loadingPlaceHolderCellAttributes = ['class' => '', 'default' => true];

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
        return $this->getCustomAttributes(propertyName: 'loadingPlaceHolderRowAttributes', default: true, classicMode: true);
    }

    public function getLoadingPlaceHolderRowAttributes(): array
    {
        return $this->getCustomAttributes(propertyName: 'loadingPlaceHolderRowAttributes', default: true, classicMode: true);
    }

    public function getLoadingPlaceHolderCellAttributes(): array
    {
        return $this->getCustomAttributes(propertyName: 'loadingPlaceHolderCellAttributes', default: true, classicMode: true);

    }

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

    public function setLoadingPlaceHolderRowAttributes(array $attributes): self
    {
        $this->setCustomAttributes('loadingPlaceHolderRowAttributes', [...$this->getCustomAttributes(propertyName: 'loadingPlaceHolderRowAttributes', default: false, classicMode: true), ...$attributes]);

        return $this;
    }

    public function setLoadingPlaceHolderWrapperAttributes(array $attributes): self
    {
        $this->setCustomAttributes('loadingPlaceHolderRowAttributes', [...$this->getCustomAttributes(propertyName: 'loadingPlaceHolderRowAttributes', default: false, classicMode: true), ...$attributes]);

        return $this;
    }
}
