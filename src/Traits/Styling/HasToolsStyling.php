<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Styling;

use Illuminate\View\ComponentAttributeBag;
use Livewire\Attributes\Computed;

trait HasToolsStyling
{
    protected array $toolsAttributes = ['class' => '', 'default-colors' => true, 'default-styling' => true];

    protected array $toolBarAttributes = ['class' => '', 'default-colors' => true, 'default-styling' => true];

    #[Computed]
    public function getToolsAttributes(): array
    {
        return $this->getCustomAttributes(propertyName: 'toolsAttributes', default: false, classicMode: false);
    }

    #[Computed]
    public function getToolsAttributesBag(): ComponentAttributeBag
    {
        return $this->getCustomAttributesBagFromArray($this->getToolsAttributes());
    }

    protected function getToolBarAttributes(): array
    {
        return $this->getCustomAttributes(propertyName: 'toolBarAttributes', default: false, classicMode: false);
    }

    #[Computed]
    public function getToolBarAttributesBag(): ComponentAttributeBag
    {
        return $this->getCustomAttributesBagFromArray($this->getToolBarAttributes());

    }

    public function setToolsAttributes(array $toolsAttributes = []): self
    {
        $this->setCustomAttributes(propertyName: 'toolsAttributes', customAttributes: $toolsAttributes);

        return $this;
    }

    public function setToolBarAttributes(array $toolBarAttributes = []): self
    {
        $this->setCustomAttributes(propertyName: 'toolBarAttributes', customAttributes: $toolBarAttributes);

        return $this;
    }
}
