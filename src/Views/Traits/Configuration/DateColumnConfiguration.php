<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Configuration;

trait DateColumnConfiguration
{
    public function toFormat(string $toFormat): self
    {
        $this->toFormat = $toFormat;

        return $this;
    }

    public function fromFormat(string $fromFormat): self
    {
        $this->fromFormat = $fromFormat;

        return $this;
    }
}
