<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Helpers;

trait EventHelpers
{
    public function getEventStatus(string $event): bool
    {
        return $this->eventStatuses[$event] ?? false;
    }

    public function getEventStatusColumnSelect(): bool
    {
        return $this->getEventStatus('columnSelected');
    }

    public function getEventStatusSearchApplied(): bool
    {
        return $this->getEventStatus('searchApplied');
    }

    public function getEventStatusFilterApplied(): bool
    {
        return $this->getEventStatus('filterApplied');
    }

    public function getEventNames(): array
    {
        return ['columnSelected', 'searchApplied', 'filterApplied'];
    }

    public function getEventStatuses(): array
    {
        return [...['columnSelected' => true, 'searchApplied' => false, 'filterApplied' => false], ...$this->eventStatuses];
    }
}
