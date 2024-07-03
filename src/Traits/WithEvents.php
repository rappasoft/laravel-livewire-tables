<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

trait WithEvents
{
    public function setSortEvent(string $field, string $direction): void
    {
        $this->setSort($field, $direction);
    }

    public function clearSortEvent(): void
    {
        $this->clearSorts();
    }

    public function setFilterEvent(string $filter, string $value): void
    {
        $this->setFilter($filter, $value);
    }

    public function clearFilterEvent(): void
    {
        $this->setFilterDefaults();
    }
}
