<?php

namespace Rappasoft\LaravelLivewireTables\Exports;

use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Rappasoft\LaravelLivewireTables\Traits\ExportHelper;

/**
 * Class CSVExport.
 */
class Export implements FromQuery, WithHeadings, WithMapping
{
    use Exportable, ExportHelper;

    /**
     * @var array
     */
    public $builder;

    /**
     * @var array
     */
    public $columns;

    /**
     * CSVExport constructor.
     *
     * @param  Builder  $builder
     * @param  array  $columns
     */
    public function __construct(Builder $builder, array $columns = [])
    {
        $this->builder = $builder;
        $this->columns = $columns;
    }

    /**
     * @return array|\Illuminate\Database\Query\Builder
     */
    public function query()
    {
        return $this->builder;
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return $this->getHeadingRow();
    }

    /**
     * @param  mixed  $row
     *
     * @return array
     */
    public function map($row): array
    {
        $map = [];

        foreach ($this->columns as $column) {
            if ($column->isExportOnly() || ($column->isVisible() && $column->includedInExport())) {
                if ($column->isFormatted()) {
                    if ($column->hasExportFormat()) {
                        $map[] = $column->formattedForExport($row, $column);
                    } else {
                        $map[] = strip_tags($column->formatted($row, $column));
                    }
                } else {
                    $map[] = data_get($row, $column->getAttribute());
                }
            }
        }

        return $map;
    }
}
