<?php

namespace Rappasoft\LaravelLivewireTables\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ColumnsSelected extends LaravelLivewireTablesEvent
{
    use Dispatchable, SerializesModels;

    public array $columns;

    public function __construct(string $tableName, string $key, array $columns = [])
    {
        $this->setTableForEvent($tableName)
            ->setKeyForEvent($key)
            ->setValueForEvent($columns)
            ->setUserForEvent();

        $this->columns = $columns;
    }
}
