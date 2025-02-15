<?php

namespace Rappasoft\LaravelLivewireTables\Views\Columns\Traits\Helpers;

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
