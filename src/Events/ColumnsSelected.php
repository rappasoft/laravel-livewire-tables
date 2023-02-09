<?php

namespace Rappasoft\LaravelLivewireTables\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use JohnDoe\BlogPackage\Models\Post;

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