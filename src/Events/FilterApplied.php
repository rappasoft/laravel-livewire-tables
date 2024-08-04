<?php

namespace Rappasoft\LaravelLivewireTables\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class FilterApplied extends LaravelLivewireTablesEvent
{
    use Dispatchable, SerializesModels;


    public function __construct(string $tableName, string $key, string|array $value)
    {
        $this->setupCoreEventProperties($tableName, $key);
        $this->setValueForEvent($value);
    }
}
