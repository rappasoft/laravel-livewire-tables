<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Styling\Configuration;

trait SortingPillsStylingConfiguration
{
    public function setSortingPillsItemAttributes(array $attributes = []): self
    {
        $this->sortingPillsItemAttributes = [...$this->sortingPillsItemAttributes, ...$attributes];

        return $this;
    }

    public function setSortingPillsClearSortButtonAttributes(array $attributes = []): self
    {
        $this->sortingPillsClearSortButtonAttributes = [...$this->sortingPillsClearSortButtonAttributes, ...$attributes];

        return $this;
    }

    public function setSortingPillsClearAllButtonAttributes(array $attributes = []): self
    {
        $this->sortingPillsClearAllButtonAttributes = [...$this->sortingPillsClearAllButtonAttributes, ...$attributes];

        return $this;
    }
}
