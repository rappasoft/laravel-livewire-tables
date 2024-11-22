<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Configuration;

use Rappasoft\LaravelLivewireTables\Views\Column;

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

    public function unsetCollapsedStatuses(): void
    {
        unset($this->shouldAlwaysCollapse);
        unset($this->shouldMobileCollapse);
        unset($this->shouldTabletCollapse);
    }
}
