<?php

namespace Rappasoft\LaravelLivewireTables\DataTransferObjects;

class FilterGenericData
{
    public function __construct(public string $tableName, public string $filterLayout, public bool $isTailwind = false, public bool $isBootstrap4 = false, public bool $isBootstrap5 = false) {}

    /**
     * Convert To Array
     *
     * @return array<mixed>
     */
    public function toArray(): array
    {
        return [
            'tableName' => $this->tableName,
            'filterLayout' => $this->filterLayout,
            'isTailwind' => $this->isTailwind,
            'isBootstrap' => ($this->isBootstrap4 || $this->isBootstrap5),
            'isBootstrap4' => $this->isBootstrap4,
            'isBootstrap5' => $this->isBootstrap5,
            'localisationPath' => (config('livewire-tables.use_json_translations', false)) ? 'livewire-tables::' : 'livewire-tables::core.',
        ];
    }
}
