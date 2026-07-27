<?php

namespace Rappasoft\LaravelLivewireTables\Views\Columns\Traits\Helpers;

use DateTimeInterface;
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

    public function getValue(Model $row): DateTimeInterface|string|null
    {
        if ($this->isBaseColumn()) {
            return $row->{$this->getField()};
        }

        return $row->{$this->getRelationString().'.'.$this->getField()};
    }
}
