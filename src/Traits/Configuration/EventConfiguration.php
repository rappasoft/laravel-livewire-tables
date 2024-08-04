<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Configuration;

trait EventConfiguration
{
    public function setEventStatus(string $event, bool $status): self
    {
        $this->eventStatuses[$event] = $status;

        return $this;
    }

    public function enableEvent(string $event): self
    {
        $this->setEventStatus($event, true);

        return $this;
    }

    public function disableEvent(string $event): self
    {
        $this->setEventStatus($event, false);

        return $this;
    }

    public function enableColumnSelectEvent(): self
    {
        $this->enableEvent('columnSelected');

        return $this;
    }

    public function disableColumnSelectEvent(): self
    {
        $this->disableEvent('columnSelected');

        return $this;
    }

    public function enableSearchAppliedEvent(): self
    {
        $this->enableEvent('searchApplied');

        return $this;
    }

    public function disableSearchAppliedEvent(): self
    {
        $this->disableEvent('searchApplied');

        return $this;
    }

    public function enableFilterAppliedEvent(): self
    {
        $this->enableEvent('filterApplied');

        return $this;
    }

    public function disableFilterAppliedEvent(): self
    {
        $this->disableEvent('filterApplied');

        return $this;
    }

    public function enableAllEvents(): self
    {
        foreach ($this->getEventNames() as $eventName) {
            $this->enableEvent($eventName);
        }

        return $this;
    }

    public function disableAllEvents(): self
    {
        foreach ($this->getEventNames() as $eventName) {
            $this->disableEvent($eventName);
        }

        return $this;
    }
}
