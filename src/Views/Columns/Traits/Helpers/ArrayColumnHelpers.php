<?php

namespace Rappasoft\LaravelLivewireTables\Views\Columns\Traits\Helpers;

trait ArrayColumnHelpers
{
    public function hasSeparator(): bool
    {
        return $this->separator !== null && is_string($this->separator);
    }

    public function getSeparator(): string
    {
        return $this->separator;
    }

    public function getEmptyValue(): string
    {
        return $this->emptyValue;
    }

    public function hasDataCallback(): bool
    {
        return isset($this->dataCallback) && is_callable($this->dataCallback);
    }

    public function getDataCallback(): ?callable
    {
        return $this->dataCallback;
    }

    public function hasOutputFormatCallback(): bool
    {
        return isset($this->outputFormat) && is_callable($this->outputFormat);
    }

    public function getOutputFormatCallback(): ?callable
    {
        return $this->outputFormat;
    }

    public function hasOutputWrapperStart(): bool
    {
        return $this->outputWrapperStart !== null && is_string($this->outputWrapperStart);
    }

    public function getOutputWrapperStart(): string
    {
        return $this->outputWrapperStart;
    }

    public function hasOutputWrapperEnd(): bool
    {
        return $this->outputWrapperEnd !== null && is_string($this->outputWrapperEnd);
    }

    public function getOutputWrapperEnd(): string
    {
        return $this->outputWrapperEnd;
    }
}
