<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Styling\Helpers;

use Rappasoft\LaravelLivewireTables\Views\Column;

trait FooterStylingHelpers
{
    /**
     * @param  mixed  $rows
     * @return array<mixed>
     */
    public function getFooterTrAttributes($rows): array
    {
        return isset($this->footerTrAttributesCallback) ? call_user_func($this->footerTrAttributesCallback, $rows) : ['default' => true];
    }

    /**
     * @param  mixed  $rows
     * @return array<mixed>
     */
    public function getFooterTdAttributes(Column $column, $rows, int $index): array
    {
        return isset($this->footerTdAttributesCallback) ? call_user_func($this->footerTdAttributesCallback, $column, $rows, $index) : ['default' => true];
    }
}
