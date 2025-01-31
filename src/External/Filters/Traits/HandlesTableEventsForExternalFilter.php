<?php

namespace Rappasoft\LaravelLivewireTables\External\Filters\Traits;

use Livewire\Attributes\{On,Renderless};

trait HandlesTableEventsForExternalFilter
{
    #[On('filter-was-set')]
    public function setFilterValues(string $tableName, string $filterKey, string|array|null $value = []): void
    {
        if (! is_null($value) && $tableName == $this->tableName && $filterKey == $this->filterKey && $this->optionsSelected != $value) {
            $this->optionsSelected = $value;
        }
    }

    #[Renderless]
    public function renderingHandlesTableEventsForExternalFilter(\Illuminate\View\View $view, array $data = []): void
    {
        if ($this->needsUpdating) {
            $this->needsUpdating = false;
            $this->dispatch('livewireArrayFilterUpdateValuesNew', tableName: $this->tableName, filterKey: $this->filterKey, values: $this->optionsSelected)->to($this->tableComponent);
        }
    }
}
