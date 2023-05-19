<?php

namespace Rappasoft\LaravelLivewireTables\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ColumnsSelected
{
    use Dispatchable, SerializesModels;

    public $columns;

    public $key;

    public function __construct($key, $columns)
    {
        $this->key = $key;
        $this->columns = $columns;
    }
}
