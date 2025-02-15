<?php

namespace Rappasoft\LaravelLivewireTables\Views\Columns\Traits\Helpers;

trait DateColumnHelpers
{
    /**
     * Retrieve the Empty Value to use for the Column
     */
    public function getEmptyValue(): string
    {
        return $this->emptyValue;
    }
}
