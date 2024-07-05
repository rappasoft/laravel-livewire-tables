<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Configuration;

use Illuminate\Database\Eloquent\{Builder, Model};
use Rappasoft\LaravelLivewireTables\Views\Column;

trait AggregateColumnConfiguration
{
    public function setDataSource(string $dataSource): self
    {
        $this->dataSource = $dataSource;
        $this->label(fn ($row, Column $column) => $row->{$dataSource.'_'.$this->getAggregateMethod()});

        return $this;
    }

    public function setAggregateMethod(string $aggregateMethod): self
    {
        $this->aggregateMethod = $aggregateMethod;

        return $this;
    }

    public function sortable(?callable $callback = null): self
    {
        $this->sortable = true;
        $this->sortCallback = ($callback === null) ? fn (Builder $query, string $direction) => $query->orderBy($this->getDataSource().'_'.$this->getAggregateMethod(), $direction) : $callback;

        return $this;
    }
}
