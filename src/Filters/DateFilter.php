<?php

namespace Rappasoft\LaravelLivewireTables\Filters;

use Carbon\Carbon;

class DateFilter extends BaseFilter
{
    public $type = 'date';

    public $view = 'date-filter';

    public function passValuesFromRequestToFilter($values): Carbon
    {
        return new Carbon($values);
    }
}
