<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Configuration;

use Closure;

trait ArrayColumnConfiguration
{
    public function separator(string $value): self
    {
        $this->separator = $value;

        return $this;
    }

    public function data(callable $callable): self
    {
        $this->dataCallback = $callable;

        return $this;
    }

    public function outputFormat(callable $callable): self
    {
        $this->outputFormat = $callable;

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
