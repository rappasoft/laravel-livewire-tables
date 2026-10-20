<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Http\Livewire;

class PetsTableFilterHooks extends PetsTable
{
    public array $filterHookLog = [];

    public function configure(): void
    {
        parent::configure();
        $this->enableFilterAppliedEvent();
    }

    public function filterUpdated(string $filter, string|array|null $value): void
    {
        $this->filterHookLog[] = ['updated', $filter, $value];
    }

    public function filterRemoved(string $filter): void
    {
        $this->filterHookLog[] = ['removed', $filter];
    }

    public function filterReset(string $filter): void
    {
        $this->filterHookLog[] = ['reset', $filter];
    }
}
