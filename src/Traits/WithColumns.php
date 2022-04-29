<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Illuminate\Support\Collection;
use Rappasoft\LaravelLivewireTables\Traits\Helpers\ColumnHelpers;

trait WithColumns
{
    use ColumnHelpers;

    protected Collection $columns;

    public function bootWithColumns(): void
    {
        $this->columns = collect();
    }
}
