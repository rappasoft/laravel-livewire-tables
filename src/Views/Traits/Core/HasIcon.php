<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Core;

use Illuminate\View\ComponentAttributeBag;
use Livewire\Attributes\Computed;

trait HasIcon
{
    public ?string $icon;

    public array $iconAttributes = ['default-styling' => true];

    public function setIcon(string $icon): self
    {
        $this->icon = $icon;

        return $this;
    }

    public function hasIcon(): bool
    {
        return isset($this->icon);
    }

    public function getIcon(): string
    {
        return $this->icon;
    }

    public function setIconAttributes(array $iconAttributes): self
    {
        $this->iconAttributes = [...['default-styling' => true], ...$iconAttributes];

        return $this;
    }

    public function getIconAttributes(): ComponentAttributeBag
    {
        return new ComponentAttributeBag([...['default-styling' => true], ...$this->iconAttributes]);
    }
}
