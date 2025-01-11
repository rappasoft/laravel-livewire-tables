<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Columns;

trait HasComponentView
{
    protected string $componentView;

    public function component(string $component): self
    {
        $this->componentView = 'components.'.$component;

        return $this;
    }

    public function getComponentView(): string
    {
        return $this->componentView;
    }

    public function hasComponentView(): bool
    {
        return isset($this->componentView);
    }
}