<?php

namespace Rappasoft\LaravelLivewireTables\Views\Columns\Traits\Helpers;

use Illuminate\Database\Eloquent\Model;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;

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
