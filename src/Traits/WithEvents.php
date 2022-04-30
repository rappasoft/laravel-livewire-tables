<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

trait WithEvents
{
    public function setSortEvent($field, $direction)
    {
        $this->setSort($field, $direction);
    }

    public function clearSortEvent()
    {
        $this->clearSorts();
    }

    public function setFilterEvent($filter, $value)
    {
        $this->setFilter($filter, $value);
    }

    public function clearFilterEvent()
    {
        $this->setFilterDefaults();
    }
}
