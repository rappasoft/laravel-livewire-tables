<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Core;

use Illuminate\View\ComponentAttributeBag;

trait HasIcon
{
    public ?string $icon;
    public ?array $iconAttributes;

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
        $this->iconAttributes = $iconAttributes;

        return $this;
    }

    public function hasIconAttributes(): bool
    {
        return isset($this->iconAttributes);
    }

    public function getIconAttributes(): array
    {
        return $this->iconAttributes;
    }

    public function getIconAttributesBag(): ComponentAttributeBag
    {
        return new ComponentAttributeBag($this->hasIconAttributes() ? $this->getIconAttributes() : ['default' => true]);
    }

}