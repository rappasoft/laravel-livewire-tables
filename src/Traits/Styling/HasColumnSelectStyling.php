<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Styling;

use Illuminate\View\ComponentAttributeBag;
use Livewire\Attributes\Computed;

trait HasColumnSelectStyling
{
    protected array $columnSelectButtonAttributes = ['default-styling' => true, 'default-colors' => true, 'class' => ''];

    protected array $columnSelectMenuOptionCheckboxAttributes = ['default-styling' => true, 'default-colors' => true, 'class' => ''];

    #[Computed]
    public function getColumnSelectButtonAttributes(): array
    {
        return $this->columnSelectButtonAttributes;
    }

    #[Computed]
    public function getColumnSelectMenuOptionCheckboxAttributes(): array
    {
        return $this->columnSelectMenuOptionCheckboxAttributes;
    }

    public function setColumnSelectButtonAttributes(array $attributes = []): self
    {
        $this->columnSelectButtonAttributes = [...$this->columnSelectButtonAttributes, ...$attributes];

        return $this;
    }

    public function setColumnSelectMenuOptionCheckboxAttributes(array $attributes = []): self
    {
        $this->columnSelectMenuOptionCheckboxAttributes = [...$this->columnSelectMenuOptionCheckboxAttributes, ...$attributes];

        return $this;
    }
}
