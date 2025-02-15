<?php

namespace Rappasoft\LaravelLivewireTables\Views\Columns\Traits;

trait HasInputOutputFormat
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
     * Retrieve the outputFormat to use for the Column
     */
    public function getOutputFormat(): string
    {
        return $this->outputFormat;
    }

    /**
     * Retrieve the inputFormat to use for the Column
     */
    public function getInputFormat(): string
    {
        return $this->inputFormat;
    }
}
