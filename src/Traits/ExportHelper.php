<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

/**
 * Trait ExportHelper.
 */
trait ExportHelper
{
    /**
     * @return array
     */
    public function getHeadingRow(): array
    {
        $headers = [];

        foreach ($this->columns as $column) {
            if ($column->isVisible() && $column->includedInExport()) {
                $headers[] = $column->getText();
            }
        }

        return $headers;
    }
}
