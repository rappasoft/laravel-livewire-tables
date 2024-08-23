<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Core;

trait HasLabel
{
    public string $label = '';

    public function getLabel(): string
    {
        return $this->label;
    }
}
