<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Helpers;

use Rappasoft\LaravelLivewireTables\Views\Column;

trait SecondaryHeaderHelpers
{
    public function hasColumnsWithSecondaryHeader(): bool
    {
        return $this->columnsWithSecondaryHeader === true;
    }

    public function getSecondaryHeaderStatus(): bool
    {
        return $this->secondaryHeaderStatus;
    }

    public function secondaryHeaderIsEnabled(): bool
    {
        return $this->getSecondaryHeaderStatus() === true;
    }

    public function secondaryHeaderIsDisabled(): bool
    {
        return $this->getSecondaryHeaderStatus() === false;
    }

    public function getSecondaryHeaderTrAttributes(mixed $rows): array
    {
        return isset($this->secondaryHeaderTrAttributesCallback) ? call_user_func($this->secondaryHeaderTrAttributesCallback, $rows) : ['default' => true];
    }

    public function getSecondaryHeaderTdAttributes(Column $column, mixed $rows, int $index): array
    {
        return isset($this->secondaryHeaderTdAttributesCallback) ? call_user_func($this->secondaryHeaderTdAttributesCallback, $column, $rows, $index) : ['default' => true];
    }
}
