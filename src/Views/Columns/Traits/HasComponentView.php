<?php

namespace Rappasoft\LaravelLivewireTables\Views\Columns\Traits;

use Illuminate\Support\Facades\View;

trait HasComponentView
{
    protected string $componentView;

    public function component(string $component): self
    {
        if (View::exists('components.'.$component)) {
            $this->componentView = 'components.'.$component;
        } elseif (View::exists($component)) {
            $this->componentView = $component;
        }

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
