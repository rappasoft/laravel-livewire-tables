<?php

namespace Rappasoft\LaravelLivewireTables\Views\Columns\Traits\Configuration;

trait DateColumnConfiguration
{
    /**
     * Define the Empty Value to use for the Column
     */
    public function emptyValue(string $emptyValue): self
    {
        $this->emptyValue = $emptyValue;

        return $this;
    }
}
