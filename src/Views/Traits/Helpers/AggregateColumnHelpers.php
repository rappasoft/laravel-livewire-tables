<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Helpers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\View\ComponentAttributeBag;

trait AggregateColumnHelpers
{
    public function getDataSource(): string
    {

        return $this->dataSource;
    }

    public function hasDataSource(): bool
    {
        return isset($this->dataSource);
    }

    public function getAggregateMethod(): string
    {
        return $this->aggregateMethod;
    }

    public function hasForeignColumn(): bool
    {
        return isset($this->foreignColumn);
    }

    public function getForeignColumn(): string
    {
        return $this->foreignColumn;
    }
}
