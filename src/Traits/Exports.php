<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Exception;
use Maatwebsite\Excel\Excel;
use Rappasoft\LaravelLivewireTables\Exceptions\UnsupportedExportFormatException;

/**
 * Trait Exports.
 */
trait Exports
{
    /**
     * @var string
     */
    public $exportFileName = 'data';

    /**
     * @var bool
     */
    public $exports = [];

    /**
     * @param $type
     *
     * @return mixed
     * @throws Exception
     */
    public function export($type)
    {
        $type = strtolower($type);

        if (! in_array($type, ['csv', 'xls', 'xlsx'], true)) {
            throw new UnsupportedExportFormatException(__('This export type is not supported.'));
        }

        if (! in_array($type, array_map('strtolower', $this->exports), true)) {
            throw new UnsupportedExportFormatException(__('This export type is not set on this table component.'));
        }

        switch ($type) {
            case 'csv':default:
                $writer = Excel::CSV;
                break;

            case 'xls':
                $writer = Excel::XLS;
                break;

            case 'xlsx':
                $writer = Excel::XLSX;
                break;
        }

        $class = config('laravel-livewire-tables.exports');

        return (new $class(
            $this->models(),
            $this->columns(),
        ))->download($this->exportFileName.'.'.$type, $writer);
    }
}
