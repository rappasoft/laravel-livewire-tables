<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Configuration;

trait ColumnConfiguration
{
    public function setPrependedColumns(array $prependedColumns): void
    {
        $this->prependedColumns = collect($prependedColumns);
        $this->hasRunColumnSetup = false;
    }

    public function setAppendedColumns(array $appendedColumns): void
    {
        $this->appendedColumns = collect($appendedColumns);
        $this->hasRunColumnSetup = false;
    }
}
