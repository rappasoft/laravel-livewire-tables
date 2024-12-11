<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Styling\Configuration;

trait PaginationStylingConfiguration
{
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
