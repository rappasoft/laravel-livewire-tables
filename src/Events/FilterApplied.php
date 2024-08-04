<?php

namespace Rappasoft\LaravelLivewireTables\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class FilterApplied extends LaravelLivewireTablesEvent
{
    use Dispatchable, SerializesModels;

    public function __construct(string $tableName, string $key, string|array|null $value = null)
    {
        $this->setTableForEvent($tableName)
            ->setKeyForEvent($key)
            ->setValueForEvent($value)
            ->setUserForEvent();

    }
}
