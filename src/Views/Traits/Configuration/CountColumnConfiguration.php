<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Configuration;

use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Database\Eloquent\{Builder, Model};

trait CountColumnConfiguration
{
    public function setCountSource(string $countSource): self
    {
        $this->countSource = $countSource;
        $this->label(fn ($row, Column $column) => $row->{$countSource.'_count'});

        return $this;
    }

    public function sortable(?callable $callback = null): self
    {
        $this->sortable = true;
        $this->sortCallback = ($callback === null) ? fn (Builder $query, string $direction) => $query->orderBy($this->countSource.'_count', $direction) : $callback;

        return $this;
    }
}
