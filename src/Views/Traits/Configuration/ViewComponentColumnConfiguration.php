<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Configuration;

trait ViewComponentColumnConfiguration
{
    public function customComponent(string $customComponentView): self
    {
        $this->customComponentView = $customComponentView;

        return $this;
    }
}
