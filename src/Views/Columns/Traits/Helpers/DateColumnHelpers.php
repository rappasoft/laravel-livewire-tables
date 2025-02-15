<?php

namespace Rappasoft\LaravelLivewireTables\Views\Columns\Traits\Helpers;

use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Model;

trait DateColumnHelpers
{
    /**
     * Retrieve the Empty Value to use for the Column
     */
    public function getEmptyValue(): string
    {
        return $this->emptyValue;
    }

    public function getValue(Model $row): Carbon|DateTime|string|null
    {
        if ($this->isBaseColumn()) {
            return $row->{$this->getField()};
        }

        return $row->{$this->getRelationString().'.'.$this->getField()};
    }
}
