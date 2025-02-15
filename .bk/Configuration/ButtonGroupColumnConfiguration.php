<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Configuration;

trait ButtonGroupColumnConfiguration
{
    public function buttons(array $buttons): self
    {
        $this->buttons = $buttons;

        return $this;
    }
}
