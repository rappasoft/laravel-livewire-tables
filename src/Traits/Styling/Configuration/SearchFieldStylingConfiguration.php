<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Styling\Configuration;

trait SearchFieldStylingConfiguration
{
    protected function setSearchIcon(string $searchIcon): self
    {
        $this->searchIcon = $searchIcon;
        $this->searchIconSet = true;

        return $this;
    }

    public function setSearchIconAttributes(array $attributes = []): self
    {
        $this->setCustomAttributes('searchIconAttributes', array_merge(['default' => false, 'default-colors' => false, 'default-styling' => false], $attributes));

        return $this;
    }

    public function setSearchFieldAttributes(array $attributes = []): self
    {
        $this->setCustomAttributes('searchFieldAttributes', array_merge(['default' => false, 'default-colors' => false, 'default-styling' => false], $attributes));

        return $this;
    }
}
