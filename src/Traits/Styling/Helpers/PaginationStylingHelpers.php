<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Styling\Helpers;

use Illuminate\View\ComponentAttributeBag;
use Livewire\Attributes\Computed;

trait PaginationStylingHelpers
{
    #[Computed]
    public function getPerPageFieldAttributes(): array
    {
        return $this->perPageFieldAttributes;
    }

    public function getPaginationWrapperAttributes(): array
    {
        return $this->paginationWrapperAttributes ?? ['class' => ''];
    }

    #[Computed]
    public function getPaginationWrapperAttributesBag(): ComponentAttributeBag
    {
        return new ComponentAttributeBag($this->getPaginationWrapperAttributes());
    }
}
