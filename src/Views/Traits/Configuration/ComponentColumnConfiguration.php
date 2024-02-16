<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Configuration;

trait ComponentColumnConfiguration
{
    public function setComponentView(string $component): self
    {
        $this->componentView = $component;

        return $this;
    }
    
    public function component(string $component): self
    {
        return $this->setComponentView('components.'.$component);
    }

    public function slot(callable $callback): self
    {
        $this->slotCallback = $callback;

        return $this;
    }
}
