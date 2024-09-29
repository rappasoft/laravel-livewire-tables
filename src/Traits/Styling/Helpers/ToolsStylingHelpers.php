<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Styling\Helpers;

use Livewire\Attributes\Computed;
use Illuminate\View\ComponentAttributeBag;

trait ToolsStylingHelpers
{

    protected function getToolsAttributes(): array
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
}