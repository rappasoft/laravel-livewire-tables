<?php

namespace Rappasoft\LaravelLivewireTables\Views\Columns\Traits\Configuration;

use Closure;

trait ColorColumnConfiguration
{
    public function color(Closure $callback): self
    {
        $this->colorCallback = $callback;

        return $this;
    }
}
