<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Helpers;

use Rappasoft\LaravelLivewireTables\Views\Column;

trait SecondaryHeaderHelpers
{
    /**
     * @return bool
     */
    public function hasColumnsWithSecondaryHeader(): bool
    {
        return $this->columnsWithSecondaryHeader === true;
    }

    /**
     * @return bool
     */
    public function getSecondaryHeaderStatus(): bool
    {
        return $this->secondaryHeaderStatus;
    }

    /**
     * @return bool
     */
    public function secondaryHeaderIsEnabled(): bool
    {
        return $this->getSecondaryHeaderStatus() === true;
    }

    /**
     * @return bool
     */
    public function secondaryHeaderIsDisabled(): bool
    {
        return $this->getSecondaryHeaderStatus() === false;
    }

    /**
     * @param mixed $rows
     *
     * @return array<mixed>
     */
    public function getSecondaryHeaderTrAttributes($rows): array
    {
        return $this->secondaryHeaderTrAttributesCallback ? call_user_func($this->secondaryHeaderTrAttributesCallback, $rows) : ['default' => true];
    }

    /**
     * @param Column $column
     * @param mixed $rows
     * @param int $index
     *
     * @return array<mixed>
     */
    public function getSecondaryHeaderTdAttributes(Column $column, $rows, int $index): array
    {
        return $this->secondaryHeaderTdAttributesCallback ? call_user_func($this->secondaryHeaderTdAttributesCallback, $column, $rows, $index) : ['default' => true];
    }
}
