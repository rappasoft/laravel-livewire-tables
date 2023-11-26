<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

trait WithEvents
{
    public function setSortEvent($field, $direction): void
    {
        $this->setSort($field, $direction);
    }

    public function clearSortEvent(): void
    {
        $this->clearSorts();
    }

    public function setFilterEvent($filter, $value): void
    {
        $this->setFilter($filter, $value);
    }

    public function clearFilterEvent(): void
    {
        $this->setFilterDefaults();
    }
}
