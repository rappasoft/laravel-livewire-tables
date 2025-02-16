<?php

namespace Rappasoft\LaravelLivewireTables\Views\Columns\Traits\Configuration;

use Closure;

trait IconColumnConfiguration
{
    public function setIcon(Closure $callback): self
    {
        $this->iconCallback = $callback;

        return $this;
    }
}
