<?php

namespace Rappasoft\LaravelLivewireTables\Filters;

use Rappasoft\LaravelLivewireTables\Filters\Traits\HasOptions;

class SelectFilter extends BaseFilter
{
    use HasOptions;

    public $type = 'select';

    public $view = 'select-filter';
}
