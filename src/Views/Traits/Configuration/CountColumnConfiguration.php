<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Configuration;

use Illuminate\Database\Eloquent\{Builder, Model};
use Rappasoft\LaravelLivewireTables\Views\Column;

trait CountColumnConfiguration
{
    public function setDataSource(string $dataSource): self
    {
        $this->dataSource = $dataSource;
        $this->label(fn ($row, Column $column) => $row->{$dataSource.'_count'});

        return $this;
    }

    public function sortable(?callable $callback = null): self
    {
        $this->sortable = true;
        $this->sortCallback = ($callback === null) ? fn (Builder $query, string $direction) => $query->orderBy($this->dataSource.'_count', $direction) : $callback;

        return $this;
    }
}
