<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Columns;

use Closure;
use Illuminate\View\ComponentAttributeBag;
use Rappasoft\LaravelLivewireTables\Views\{Column,Filter};

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
