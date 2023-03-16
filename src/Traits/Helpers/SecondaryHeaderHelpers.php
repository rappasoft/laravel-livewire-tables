<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Helpers;

use Rappasoft\LaravelLivewireTables\Views\Column;

trait SecondaryHeaderHelpers
{
    /**
     * @var bool
     */
    public function hasColumnsWithSecondaryHeader(): bool
    {
        return $this->columnsWithSecondaryHeader === true;
    }

    /**
     * @var bool
     */
    public function getSecondaryHeaderStatus(): bool
    {
        return $this->secondaryHeaderStatus;
    }

    /**
     * @var bool
     */
    public function secondaryHeaderIsEnabled(): bool
    {
        return $this->getSecondaryHeaderStatus() === true;
    }

    /**
     * @var bool
     */
    public function secondaryHeaderIsDisabled(): bool
    {
        return $this->getSecondaryHeaderStatus() === false;
    }

    /**
     * @var bool
     */
    public function getSecondaryHeaderTrAttributes($rows): array
    {
        return $this->secondaryHeaderTrAttributesCallback ? call_user_func($this->secondaryHeaderTrAttributesCallback, $rows) : ['default' => true];
    }

    /**
     * @var bool
     */
    public function getSecondaryHeaderTdAttributes(Column $column, $rows, int $index): array
    {
        return $this->secondaryHeaderTdAttributesCallback ? call_user_func($this->secondaryHeaderTdAttributesCallback, $column, $rows, $index) : ['default' => true];
    }
}
