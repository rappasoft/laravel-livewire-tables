<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Helpers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\View\ComponentAttributeBag;

trait ColorColumnHelpers
{
    // TODO: Test
    public function getColor(Model|int $row): string
    {
        return $this->hasColorCallback() ? app()->call($this->getColorCallback(), ['row' => $row, 'value' => $row->{$this->getFrom()} ?? '']) : ($this->getValue($row));
    }

    public function getColorCallback(): ?callable
    {
        return $this->colorCallback;
    }

    public function hasColorCallback(): bool
    {
        return isset($this->colorCallback);
    }
}
