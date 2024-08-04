<?php

namespace Rappasoft\LaravelLivewireTables\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ColumnsSelected
{
    use Dispatchable, SerializesModels;

    public string $tableName;

    public array $columns;

    public string $key;

    public function __construct(string $tableName, string $key, array $columns)
    {
        $this->tableName = $tableName;
        $this->key = $key;
        $this->columns = $columns;
    }
}
