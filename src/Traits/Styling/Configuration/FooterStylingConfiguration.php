<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Styling\Configuration;

use Closure;

trait FooterStylingConfiguration
{
    public function setFooterTrAttributes(Closure $callback): self
    {
        $this->footerTrAttributesCallback = $callback;

        return $this;
    }

    public function setFooterTdAttributes(Closure $callback): self
    {
        $this->footerTdAttributesCallback = $callback;

        return $this;
    }
}
