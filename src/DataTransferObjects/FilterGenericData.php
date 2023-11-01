<?php

namespace Rappasoft\LaravelLivewireTables\DataTransferObjects;

use Rappasoft\LaravelLivewireTables\DataTableComponent;

class FilterGenericData
{
    public DataTableComponent $component;

    public function __construct(DataTableComponent $component)
    {
        $this->component = $component;
    }

    public function toArray(): array
    {
        return [
            'tableName' => $this->component->getTableName(),
            'filterLayout' => $this->component->getFilterLayout(),
            'isTailwind' => $this->component->isTailwind(),
            'isBootstrap' => ($this->component->isBootstrap4() || $this->component->isBootstrap5()),
            'isBootstrap4' => $this->component->isBootstrap4(),
            'isBootstrap5' => $this->component->isBootstrap5(),
        ];
    }
}
