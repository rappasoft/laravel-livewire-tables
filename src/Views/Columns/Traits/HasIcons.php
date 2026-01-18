<?php

namespace Rappasoft\LaravelLivewireTables\Views\Columns\Traits;

use Illuminate\View\ComponentAttributeBag;

trait HasIcons
{
    public ?string $iconLeft = null;

    public ?string $iconRight = null;

    public array $iconLeftAttributes = ['class' => 'w-4 h-4', 'default-styling' => true];

    public array $iconRightAttributes = ['class' => 'w-4 h-4', 'default-styling' => true];

    public function setIconLeft(string $icon): self
    {
        $this->iconLeft = $icon;

        return $this;
    }

    public function setIconRight(string $icon): self
    {
        $this->iconRight = $icon;

        return $this;
    }

    public function setIcon(string $icon): self
    {
        return $this->setIconRight($icon);
    }

    public function hasIconLeft(): bool
    {
        return isset($this->iconLeft);
    }

    public function hasIconRight(): bool
    {
        return isset($this->iconRight);
    }

    public function hasIcon(): bool
    {
        return $this->hasIconLeft() || $this->hasIconRight();
    }

    public function getIconLeft(): ?string
    {
        return $this->iconLeft;
    }

    public function getIconRight(): ?string
    {
        return $this->iconRight;
    }

    public function setIconLeftAttributes(array $iconAttributes): self
    {
        $this->iconLeftAttributes = [...$this->iconLeftAttributes, ...$iconAttributes];

        return $this;
    }

    public function setIconRightAttributes(array $iconAttributes): self
    {
        $this->iconRightAttributes = [...$this->iconRightAttributes, ...$iconAttributes];

        return $this;
    }

    public function setIconAttributes(array $iconAttributes): self
    {
        $this->setIconLeftAttributes($iconAttributes);
        $this->setIconRightAttributes($iconAttributes);

        return $this;
    }

    public function getIconLeftAttributes(): ComponentAttributeBag
    {
        return new ComponentAttributeBag([...['class' => 'w-4 h-4', 'default-styling' => true], ...$this->iconLeftAttributes]);
    }

    public function getIconRightAttributes(): ComponentAttributeBag
    {
        return new ComponentAttributeBag([...['class' => 'w-4 h-4', 'default-styling' => true], ...$this->iconRightAttributes]);
    }
}
