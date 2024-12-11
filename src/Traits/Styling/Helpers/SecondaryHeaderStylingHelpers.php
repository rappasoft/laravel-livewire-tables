<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Styling\Helpers;

use Rappasoft\LaravelLivewireTables\Views\Column;

trait SecondaryHeaderStylingHelpers
{
    /**
     * @param  mixed  $rows
     * @return array<mixed>
     */
    public function getSecondaryHeaderTrAttributes($rows): array
    {
        return isset($this->secondaryHeaderTrAttributesCallback) ? call_user_func($this->secondaryHeaderTrAttributesCallback, $rows) : ['default' => true];
    }

    /**
     * @param  mixed  $rows
     * @return array<mixed>
     */
    public function getSecondaryHeaderTdAttributes(Column $column, $rows, int $index): array
    {
        return isset($this->secondaryHeaderTdAttributesCallback) ? call_user_func($this->secondaryHeaderTdAttributesCallback, $column, $rows, $index) : ['default' => true];
    }
}
