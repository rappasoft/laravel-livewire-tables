<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Styling;

use Livewire\Attributes\Computed;

trait HasSortingPillsStyling
{
    protected array $sortingPillsItemAttributes = ['default-styling' => true, 'default-colors' => true, 'class' => ''];

    protected array $sortingPillsClearSortButtonAttributes = ['default-styling' => true, 'default-colors' => true, 'class' => ''];

    protected array $sortingPillsClearAllButtonAttributes = ['default-styling' => true, 'default-colors' => true, 'class' => ''];

    #[Computed]
    public function getSortingPillsItemAttributes(): array
    {
        return $this->sortingPillsItemAttributes;
    }

    #[Computed]
    public function getSortingPillsClearSortButtonAttributes(): array
    {
        return $this->sortingPillsClearSortButtonAttributes;
    }

    #[Computed]
    public function getSortingPillsClearAllButtonAttributes(): array
    {
        return $this->sortingPillsClearAllButtonAttributes;
    }

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
