<?php

namespace Rappasoft\LaravelLivewireTables\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SearchApplied
{
    use Dispatchable, SerializesModels;

    public string $tableName;

    public string $search;

    public function __construct(string $tableName, string $search)
    {
        $this->tableName = $tableName;
        $this->search = $search;
    }
}
