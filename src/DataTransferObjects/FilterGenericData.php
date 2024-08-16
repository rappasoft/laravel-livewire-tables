<?php

namespace Rappasoft\LaravelLivewireTables\DataTransferObjects;

class FilterGenericData
{
    public string $tableName;

    public string $filterLayout;

    public bool $isTailwind = false;

    public bool $isBootstrap4 = false;

    public bool $isBootstrap5 = false;

    public function __construct(string $tableName, string $filterLayout, bool $isTailwind = false, bool $isBootstrap4 = false, bool $isBootstrap5 = false)
    {
        $this->tableName = $tableName;
        $this->filterLayout = $filterLayout;
        $this->isTailwind = $isTailwind;
        $this->isBootstrap4 = $isBootstrap4;
        $this->isBootstrap5 = $isBootstrap5;
    }

    public function toArray(): array
    {
        return [
            'tableName' => $this->tableName,
            'filterLayout' => $this->filterLayout,
            'isTailwind' => $this->isTailwind,
            'isBootstrap' => ($this->isBootstrap4 || $this->isBootstrap5),
            'isBootstrap4' => $this->isBootstrap4,
            'isBootstrap5' => $this->isBootstrap5,
        ];
    }
}
