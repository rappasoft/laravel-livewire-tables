<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Configuration;

trait ButtonGroupColumnConfiguration
{
    public function buttons(array $buttons): self
    {
        $this->buttons = $buttons;

        return $this;
    }

    public function attributes(callable $callback): self
    {
        $this->attributesCallback = $callback;

        return $this;
    }
}
