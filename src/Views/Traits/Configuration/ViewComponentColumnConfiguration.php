<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Configuration;

trait ViewComponentColumnConfiguration
{
    public function component(string $component): self
    {
        $this->componentView = $component;

        return $this;
    }
}
