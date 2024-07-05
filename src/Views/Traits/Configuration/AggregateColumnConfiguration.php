<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Configuration;

use Illuminate\Database\Eloquent\{Builder, Model};
use Rappasoft\LaravelLivewireTables\Views\Column;

trait AggregateColumnConfiguration
{
    public function setDataSource(string $dataSource, ?string $foreignColumn): self
    {
        if (isset($foreignColumn))
        {
            $this->foreignColumn = $foreignColumn;
        }

        $this->dataSource = $dataSource;

        $this->setDefaultLabel();

        return $this;
    }

    public function setAggregateMethod(string $aggregateMethod): self
    {
        $this->aggregateMethod = $aggregateMethod;
        $this->setDefaultLabel();

        return $this;
    }

    public function setForeignColumn(string $foreignColumn): self
    {
        $this->foreignColumn = $foreignColumn;
        $this->setDefaultLabel();

        return $this;
    }

    public function setDefaultLabel()
    {
        $this->label(function ($row, Column $column) 
        {
            if ($this->hasForeignColumn())
            {
                return $row->{$this->getDataSource().'_'.$this->getAggregateMethod().'_'.$this->getForeignColumn()};
            }
            return $row->{$this->getDataSource().'_'.$this->getAggregateMethod()};
        });

    }

    public function sortable(?callable $callback = null): self
    {
        $this->sortable = true;

        $this->sortCallback = ($callback === null) ? ($this->hasForeignColumn() ? fn (Builder $query, string $direction) => $query->orderBy($this->getDataSource().'_'.$this->getAggregateMethod().'_'.$this->getForeignColumn(), $direction) : fn (Builder $query, string $direction) => $query->orderBy($this->dataSource.'_count', $direction)) : $callback;

        
        return $this;
    }
}
