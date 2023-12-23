<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Configuration;

use Closure;

trait AttributesConfiguration
{
    public function attributes(Closure $callback): self
    {
        $this->attributesCallback = $callback;

        return $this;
    }
}
