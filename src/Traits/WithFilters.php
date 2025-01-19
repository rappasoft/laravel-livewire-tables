<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Rappasoft\LaravelLivewireTables\Traits\Filters\HandlesFilterTraits;

trait WithFilters
{
    use HandlesFilterTraits;

    public function filters(): array
    {
        return [];
    }
}
