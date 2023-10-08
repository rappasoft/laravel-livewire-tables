<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Configuration;

use Rappasoft\LaravelLivewireTables\Views\Column;

trait ColumnConfiguration
{
    public function setPrependedColumns(array $prependedColumns): void
    {
        $this->prependedColumns = collect($prependedColumns)
            ->filter(fn ($column) => $column instanceof Column)
            ->map(function (Column $column) {
                $column->setComponent($this);

                if ($column->hasField()) {
                    if ($column->isBaseColumn()) {
                        $column->setTable($this->getBuilder()->getModel()->getTable());
                    } else {
                        $column->setTable($this->getTableForColumn($column));
                    }
                }

                return $column;
            });
    }

    public function setAppendedColumns(array $appendedColumns): void
    {
        $this->appendedColumns = collect($appendedColumns)
            ->filter(fn ($column) => $column instanceof Column)
            ->map(function (Column $column) {
                $column->setComponent($this);

                if ($column->hasField()) {
                    if ($column->isBaseColumn()) {
                        $column->setTable($this->getBuilder()->getModel()->getTable());
                    } else {
                        $column->setTable($this->getTableForColumn($column));
                    }
                }

                return $column;
            });
    }

    public function unsetCollapsedStatuses(): void
    {
        unset($this->shouldAlwaysCollapse);
        unset($this->shouldMobileCollapse);
        unset($this->shouldTabletCollapse);
    }
}
