<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Configuration;

trait DateColumnConfiguration
{
    /**
     * Define the outputFormat to use for the Column
     */
    public function outputFormat(string $outputFormat): self
    {
        $this->outputFormat = $outputFormat;

        return $this;
    }

    /**
     * Define the inputFormat to use for the Column
     */
    public function inputFormat(string $inputFormat): self
    {
        $this->inputFormat = $inputFormat;

        return $this;
    }

    /**
     * Define the Empty Value to use for the Column
     */
    public function emptyValue(string $emptyValue): self
    {
        $this->emptyValue = $emptyValue;

        return $this;
    }
}
