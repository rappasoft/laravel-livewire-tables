<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Columns;

trait HasDefaultStringValue
{
    public string $defaultValue = '';

    public function defaultValue(string $defaultValue): self
    {
        $this->defaultValue = $defaultValue;

        return $this;
    }

    public function getDefaultValue(): string
    {
        return $this->defaultValue;
    }
}
