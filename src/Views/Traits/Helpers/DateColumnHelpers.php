<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Helpers;

use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Model;

trait DateColumnHelpers
{
    /**
     * Retrieve the outputFormat to use for the Column
     */
    public function getOutputFormat(): string
    {
        return $this->outputFormat ?? 'Y-m-d';
    }

    /**
     * Retrieve the inputFormat to use for the Column
     */
    public function getInputFormat(): ?string
    {
        return $this->inputFormat ?? null;
    }

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
