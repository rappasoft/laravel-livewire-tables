<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Rappasoft\LaravelLivewireTables\Utilities\ColumnUtilities;

/**
 * Trait ComponentHelpers.
 */
trait ComponentHelpers
{
    /**
     * Get a column object by its field
     *
     * @param  string  $column
     *
     * @return mixed
     */
    protected function getColumn(string $column)
    {
        return collect($this->columns())
            ->where('column', $column)
            ->first();
    }

    /**
     * @param  string  $field
     *
     * @return string
     */
    protected function parseField(string $field): string
    {
        return ColumnUtilities::parseField($field);
    }
}
