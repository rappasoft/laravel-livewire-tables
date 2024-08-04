<?php

namespace Rappasoft\LaravelLivewireTables\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SearchApplied extends LaravelLivewireTablesEvent
{
    use Dispatchable, SerializesModels;

    public function __construct(string $tableName, string $value)
    {
        $this->setTableForEvent($tableName)
            ->setValueForEvent($value)
            ->setUserForEvent();

    }
}
