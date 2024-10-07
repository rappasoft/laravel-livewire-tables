<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Styling\Configuration;

trait PaginationStylingConfiguration
{
    public function setCustomPaginationBlade(string $customPaginationBlade): self
    {
        $this->customPaginationBlade = $customPaginationBlade;

        return $this;
    }

    public function setPaginationTheme(string $theme): self
    {
        $this->paginationTheme = $theme;

        return $this;
    }

    public function setPaginationWrapperAttributes(array $paginationWrapperAttributes = []): self
    {
        $this->setCustomAttributes(propertyName: 'paginationWrapperAttributes', customAttributes: array_merge($this->getPaginationWrapperAttributes(), $paginationWrapperAttributes));

        return $this;
    }

    public function setPerPageFieldAttributes(array $perPageFieldAttributes = []): self
    {
        $this->setCustomAttributes(propertyName: 'perPageFieldAttributes', customAttributes: array_merge($this->getPerPageFieldAttributes(), $perPageFieldAttributes));

        return $this;
    }

    public function setPerPageWrapperAttributes(array $perPageWrapperAttributes = []): self
    {
        $this->setCustomAttributes(propertyName: 'perPageWrapperAttributes', customAttributes: array_merge($this->getPerPageWrapperAttributes(), $perPageWrapperAttributes));

        return $this;
    }
}
