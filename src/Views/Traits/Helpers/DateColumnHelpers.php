<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Helpers;

trait DateColumnHelpers
{
    /**
     * Retrieve the outputFormat to use for the Column
     */
    public function getOutputFormat(): string
    {
        return $this->outputFormat ?? 'Y-m-d';
    }

    /**
     * Retrieve the inputFormat to use for the Column
     */
    public function getInputFormat(): ?string
    {
        return $this->inputFormat ?? null;
    }

    /**
     * Retrieve the Empty Value to use for the Column
     */
    public function getEmptyValue(): string
    {
        return $this->emptyValue;
    }
}
