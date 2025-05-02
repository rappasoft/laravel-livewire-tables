<?php

namespace Rappasoft\LaravelLivewireTables\DataTransferObjects;

use Rappasoft\LaravelLivewireTables\DataTableComponent;

class DebuggableData
{
    public function __construct(public DataTableComponent $component) {}

    /**
     * Returns data to an array
     *
     * @return array<mixed>
     */
    public function toArray(): array
    {
        return [
            'query' => (clone $this->component->getBuilder())->toSql(),
            'filters' => $this->component->getAppliedFilters(),
            'sorts' => $this->component->getSorts(),
            'search' => $this->component->getSearch(),
            'select-all' => $this->component->getSelectAllStatus(),
            'selected' => $this->component->getSelected(),
        ];
    }
}
