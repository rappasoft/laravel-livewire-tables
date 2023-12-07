<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Configuration;

trait DateColumnConfiguration
{
    public function setDateFormat(string $dateFormat): self
    {
        $this->dateFormat = $dateFormat;

        return $this;
    }
}
