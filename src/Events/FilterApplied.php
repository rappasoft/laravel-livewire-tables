<?php

namespace Rappasoft\LaravelLivewireTables\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class FilterApplied
{
    use Dispatchable, SerializesModels;

    public string $tableName;

    public string $key;

    public string|array $value;

    public function __construct(string $tableName, string $key, string|array $value)
    {
        $this->tableName = $tableName;
        $this->key = $key;
        $this->value = $value;
    }
}
