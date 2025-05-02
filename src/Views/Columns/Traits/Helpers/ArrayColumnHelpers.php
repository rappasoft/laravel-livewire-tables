<?php

namespace Rappasoft\LaravelLivewireTables\Views\Columns\Traits\Helpers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\HtmlString;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;

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

    public function getContents(Model $row): null|string|\BackedEnum|HtmlString|DataTableConfigurationException|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $outputValues = [];
        $value = $this->getValue($row);

        if (! $this->hasDataCallback()) {
            throw new DataTableConfigurationException('You must set a data() method on an ArrayColumn');
        }

        if (! $this->hasOutputFormatCallback()) {
            throw new DataTableConfigurationException('You must set an outputFormat() method on an ArrayColumn');
        }

        foreach (call_user_func($this->getDataCallback(), $value, $row) as $i => $v) {
            $outputValues[] = call_user_func($this->getOutputFormatCallback(), $i, $v);
        }

        $returnedValue = (! empty($outputValues) ? implode($this->getSeparator(), $outputValues) : $this->getEmptyValue());

        if ($this->hasOutputWrapperStart() && $this->hasOutputWrapperEnd()) {
            $returnedValue = $this->getOutputWrapperStart().$returnedValue.$this->getOutputWrapperEnd();
        }

        return new HtmlString($returnedValue);
    }

}
