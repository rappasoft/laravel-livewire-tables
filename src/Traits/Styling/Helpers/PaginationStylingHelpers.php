<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Styling\Helpers;

use Illuminate\View\ComponentAttributeBag;
use Livewire\Attributes\Computed;

trait PaginationStylingHelpers
{
    #[Computed]
    public function getPaginationTheme(): string
    {
        return $this->paginationTheme;
    }

    #[Computed]
    public function getPaginationWrapperAttributes(): array
    {
        return $this->getCustomAttributes(propertyName: 'paginationWrapperAttributes', default: false, classicMode: true);
    }

    #[Computed]
    public function getPaginationWrapperAttributesBag(): ComponentAttributeBag
    {
        return $this->getCustomAttributesBagFromArray($this->getPaginationWrapperAttributes());
    }

    #[Computed]
    public function getPerPageFieldAttributes(): array
    {
        return $this->getCustomAttributes(propertyName: 'perPageFieldAttributes', default: false, classicMode: false);

    }

    #[Computed]
    public function getPerPageWrapperAttributes(): array
    {
        return $this->getCustomAttributes(propertyName: 'perPageWrapperAttributes', default: false, classicMode: false);

    }

    #[Computed]
    public function hasCustomPaginationBlade(): bool
    {
        return isset($this->customPaginationBlade) && $this->customPaginationBlade !== null;
    }

    #[Computed]
    public function getCustomPaginationBlade(): string
    {
        return $this->customPaginationBlade ?? '';
    }
}
