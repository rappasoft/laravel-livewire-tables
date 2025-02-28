<?php

namespace Rappasoft\LaravelLivewireTables\External\Filters\Traits;

trait HandlesCorePropertiesForExternalFilter
{
    public string $filterKey = '';

    public string $tableName = '';

    public string $tableComponent = '';

    protected function setFilterKey(string $filterKey): self
    {
        $this->filterKey = $filterKey;

        return $this;
    }

    public function getFilterKey(): string
    {
        return $this->filterKey;
    }

    protected function setTableName(string $tableName): self
    {
        $this->tableName = $tableName;

        return $this;
    }

    public function getTableName(): string
    {
        return $this->tableName;
    }

    protected function setTableComponent(string $tableComponent): self
    {
        $this->tableComponent = $tableComponent;

        return $this;
    }

    public function getTableComponent(): string
    {
        return $this->tableComponent;
    }
}
