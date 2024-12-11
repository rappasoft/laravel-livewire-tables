<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Core;

use Illuminate\View\ComponentAttributeBag;

trait HasIcon
{
    public ?string $icon;

    public array $iconAttributes = ['class' => '', 'default-styling' => true];

    public bool $iconRight = true;

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
        $this->iconAttributes = [...$this->iconAttributes, ...$iconAttributes];

        return $this;
    }

    public function getIconAttributes(): ComponentAttributeBag
    {
        return new ComponentAttributeBag([...['class' => '', 'default-styling' => true], ...$this->iconAttributes]);
    }

    public function getIconRight(): bool
    {
        return $this->iconRight ?? true;
    }

    public function setIconLeft(): self
    {
        $this->iconRight = false;

        return $this;
    }

    public function setIconRight(): self
    {
        $this->iconRight = true;

        return $this;
    }
}
