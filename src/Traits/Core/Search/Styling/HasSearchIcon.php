<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Core\Search\Styling;

use Livewire\Attributes\Computed;

trait HasSearchIcon
{
    protected bool $searchIconSet = false;

    protected ?string $searchIcon = null;

    protected array $searchIconAttributes = ['class' => 'h-4 w-4', 'style' => 'color: #000000'];

    #[Computed]
    public function hasSearchIcon(): bool
    {
        return $this->searchIconSet;
    }

    #[Computed]
    public function getSearchIcon(): string
    {
        return $this->hasSearchIcon() ? $this->searchIcon : 'heroicon-m-magnifying-glass';
    }

    #[Computed]
    public function getSearchIconClasses(): string
    {
        return $this->getSearchIconAttributes()['class'];

    }

    #[Computed]
    public function getSearchIconAttributes(): array
    {
        return $this->searchIconAttributes;
    }

    #[Computed]
    public function getSearchIconOtherAttributes(): array
    {
        return collect($this->getSearchIconAttributes())->except('class')->toArray();
    }

    protected function setSearchIconStatus(bool $searchIconStatus): self
    {
        $this->searchIconSet = $searchIconStatus;

        return $this;
    }

    protected function searchIconEnabled(): self
    {
        return $this->setSearchIconStatus(true);
    }

    protected function searchIconDisabled(): self
    {
        return $this->setSearchIconStatus(false);
    }

    protected function setSearchIcon(string $searchIcon): self
    {
        $this->searchIcon = $searchIcon;

        return $this->searchIconEnabled();
    }

    protected function setSearchIconAttributes(array $searchIconAttributes): self
    {
        $this->searchIconAttributes = array_merge($this->searchIconAttributes, $searchIconAttributes);

        return $this->searchIconEnabled();
    }
}
