<?php

namespace Rappasoft\LaravelLivewireTables\Views\Columns\Traits\Configuration;

use Illuminate\View\ComponentAttributeBag;

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

    public function wrapperStart(string $value): self
    {
        $this->outputWrapperStart = $value;

        return $this;
    }

    public function wrapperEnd(string $value): self
    {
        $this->outputWrapperEnd = $value;

        return $this;
    }

    /**
     * Setup Flex Col Behaviour
     *
     * @param  array<mixed>  $attribs
     */
    public function flexCol(array $attribs = []): self
    {
        $bag = new ComponentAttributeBag(['class' => $this->isTailwind() ? 'flex flex-col' : 'd-flex d-flex-col']);

        return $this->wrapperStart('<div '.$bag->merge($attribs).'>')
            ->wrapperEnd('</div>')
            ->separator('');
    }

    /**
     * Setup Flex Row Behaviour
     *
     * @param  array<mixed>  $attribs
     */
    public function flexRow(array $attribs = []): self
    {
        $bag = new ComponentAttributeBag(['class' => $this->isTailwind() ? 'flex flex-row' : 'd-flex d-flex-row']);

        return $this->wrapperStart('<div '.$bag->merge($attribs).'>')
            ->wrapperEnd('</div>')
            ->separator('');
    }
}
