<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Configuration;

use Rappasoft\LaravelLivewireTables\Views\Traits\Columns;

trait ColorColumnConfiguration
{
    public function color(\Closure $callback): self
    {
        $this->colorCallback = $callback;

        return $this;
    }
}
