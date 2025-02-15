<?php

namespace Rappasoft\LaravelLivewireTables\Views\Columns\Traits\Configuration;

trait ButtonGroupColumnConfiguration
{
    public function buttons(array $buttons): self
    {
        $this->buttons = $buttons;

        return $this;
    }
}
