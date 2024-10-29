<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits;

use Livewire\Attributes\{Modelable,On,Renderless};

trait IsExternalArrayFilter
{
    #[Modelable]
    public $value = [];

    public string $filterKey = '';

    public string $tableName = '';

    public string $tableComponent = '';

    protected bool $needsUpdating = false;

    protected array $returnValues = [];

    public array $selectedItems = [];

    public array $selectOptions = [];

    #[On('filter-was-set')]
    #[Renderless]
    public function setFilterValues($tableName, $filterKey, $value)
    {
        if ($tableName == $this->tableName && $filterKey == $this->filterKey) {
            $this->selectedItems = $value;
            $this->clearFilter();
            $this->needsUpdating = false;

        }
    }

    protected function clearFilter() {}

    #[Renderless]
    public function updatedSelectedItems($values)
    {
        $this->needsUpdating = true;
    }

    protected function enableUpdateDispatch(): void
    {
        $this->needsUpdating = true;
    }

    protected function disableUpdateDispatch(): void
    {
        $this->needsUpdating = false;
    }

    #[Renderless]
    protected function sendUpdateDispatch(array $returnValues)
    {
        if ($this->needsUpdating) {
            if (! empty($returnValues)) {
                $this->dispatch('livewireArrayFilterUpdateValues', tableName: $this->tableName, filterKey: $this->filterKey, values: $returnValues)->to($this->tableComponent);
                $this->value = array_keys($returnValues);
            } else {
                $this->value = [];
            }
            $this->needsUpdating = false;

        }
    }

    public function renderingIsExternalArrayFilter()
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
