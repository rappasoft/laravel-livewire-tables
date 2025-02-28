<?php

namespace Rappasoft\LaravelLivewireTables\Views\Filters\Traits;

use Livewire\Attributes\{Modelable, On, Renderless};

trait IsExternalArrayFilter
{
    #[Modelable]
    public array $value = [];

    public string $filterKey = '';

    public string $tableName = '';

    public string $tableComponent = '';

    protected bool $needsUpdating = false;

    protected array $returnValues = [];

    public array $selectedItems = [];

    public array $selectOptions = [];

    #[On('filter-was-set')]
    public function setFilterValues(string $tableName, string $filterKey, array $value): void
    {
        if ($tableName == $this->tableName && $filterKey == $this->filterKey && $this->selectedItems != $value) {
            $this->selectedItems = $value;
            $this->needsUpdating = false;

        }
    }

    protected function clearFilter() {}

    #[Renderless]
    public function updatedSelectedItems(string $value): void
    {
        if (! $this->needsUpdating) {
            $this->needsUpdating = true;

        }
    }

    #[Renderless]
    protected function sendUpdateDispatch(array $returnValues): void
    {
        if ($this->needsUpdating) {
            if (! empty($returnValues)) {
                $this->value = array_keys($returnValues);
            } else {
                $this->value = [];
            }
            $this->dispatch('livewireArrayFilterUpdateValues', tableName: $this->tableName, filterKey: $this->filterKey, values: $returnValues)->to($this->tableComponent);

        }
    }

    #[Renderless]
    public function renderingIsExternalArrayFilter(\Illuminate\View\View $view, array $data = []): void
    {
        $returnValues = [];

        if ($this->needsUpdating == true && ! empty($this->selectedItems)) {
            foreach ($this->selectedItems as $selectedItem) {
                $returnValues[$selectedItem] = $this->selectOptions[$selectedItem] ?? 'Unknown';
            }
            $this->sendUpdateDispatch($returnValues);
        }
    }
}
