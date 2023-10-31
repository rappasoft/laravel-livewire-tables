<?php

namespace Rappasoft\LaravelLivewireTables\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ColumnsSelected
{
    use Dispatchable, SerializesModels;

    public array $columns;

    public string $key;

    public function __construct(string $key, array $columns)
    {
        $this->key = $key;
        $this->columns = $columns;
    }
}
