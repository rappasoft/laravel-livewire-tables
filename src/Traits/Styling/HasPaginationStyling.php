<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Styling;

use Illuminate\View\ComponentAttributeBag;
use Livewire\Attributes\Computed;

trait HasPaginationStyling
{
    protected array $perPageFieldAttributes = ['default-styling' => true, 'default-colors' => true, 'class' => ''];

    protected array $paginationWrapperAttributes = ['class' => ''];

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

    public function setPerPageFieldAttributes(array $attributes = []): self
    {
        $this->perPageFieldAttributes = [...$this->perPageFieldAttributes, ...$attributes];

        return $this;
    }

    public function setPaginationWrapperAttributes(array $paginationWrapperAttributes): self
    {
        $this->paginationWrapperAttributes = array_merge(['class' => ''], $paginationWrapperAttributes);

        return $this;
    }
}
