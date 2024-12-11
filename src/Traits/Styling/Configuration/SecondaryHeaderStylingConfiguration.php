<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Styling\Configuration;

use Closure;

trait SecondaryHeaderStylingConfiguration
{
    public function setSecondaryHeaderTrAttributes(Closure $callback): self
    {
        $this->secondaryHeaderTrAttributesCallback = $callback;

        return $this;
    }

    public function setSecondaryHeaderTdAttributes(Closure $callback): self
    {
        $this->secondaryHeaderTdAttributesCallback = $callback;

        return $this;
    }
}
