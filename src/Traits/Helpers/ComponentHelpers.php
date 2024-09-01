<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Helpers;

use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Computed;

trait ComponentHelpers
{
    public function getDataTableFingerprint(): string
    {
        return $this->dataTableFingerprint ?? ($this->dataTableFingerprint = $this->generateDataTableFingerprint());
    }

    public function setBuilder(Builder $builder): void
    {
        $this->builder = $builder;
    }

    public function getBuilder(): Builder
    {
        return $this->builder;
    }

    public function hasPrimaryKey(): bool
    {
        return isset($this->primaryKey) && $this->primaryKey !== null;
    }

    /**
     * @return mixed
     */
    #[Computed]
    public function getPrimaryKey()
    {
        return $this->primaryKey;
    }

    /**
     * @return array<mixed>
     */
    public function getRelationships(): array
    {
        return $this->relationships;
    }

    public function hasModel(): bool
    {
        return $this->model !== null;
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Get the translated empty message of the table
     */
    public function getEmptyMessage(): string
    {
        return __($this->emptyMessage);
    }

    public function getOfflineIndicatorStatus(): bool
    {
        return $this->offlineIndicatorStatus;
    }

    public function offlineIndicatorIsEnabled(): bool
    {
        return $this->getOfflineIndicatorStatus() === true;
    }

    public function offlineIndicatorIsDisabled(): bool
    {
        return $this->getOfflineIndicatorStatus() === false;
    }

    public function setTableName(string $name): string
    {
        return $this->tableName = $name;
    }

    #[Computed]
    public function getTableName(): string
    {
        return $this->tableName;
    }

    #[Computed]
    public function getTableId(): string
    {
        return $this->getTableAttributes()['id'] ?? 'table-'.$this->getTableName();
    }

    public function isTableNamed(string $name): bool
    {
        return $this->tableName === $name;
    }

    public function getEagerLoadAllRelationsStatus(): bool
    {
        return $this->eagerLoadAllRelationsStatus;
    }

    public function eagerLoadAllRelationsIsEnabled(): bool
    {
        return $this->getEagerLoadAllRelationsStatus() === true;
    }

    public function eagerLoadAllRelationsIsDisabled(): bool
    {
        return $this->getEagerLoadAllRelationsStatus() === false;
    }

    /**
     * @return array<mixed>
     */
    public function getAdditionalSelects(): array
    {
        return $this->additionalSelects;
    }

    public function hasExtraWiths(): bool
    {
        return ! empty($this->extraWiths);
    }

    public function getExtraWiths(): array
    {
        return $this->extraWiths;
    }

    public function hasExtraWithCounts(): bool
    {
        return ! empty($this->extraWithCounts);
    }

    public function getExtraWithCounts(): array
    {
        return $this->extraWithCounts;
    }

    public function hasExtraWithSums(): bool
    {
        return ! empty($this->extraWithSums);
    }

    public function getExtraWithSums(): array
    {
        return $this->extraWithSums;
    }

    public function hasExtraWithAvgs(): bool
    {
        return ! empty($this->extraWithAvgs);
    }

    public function getExtraWithAvgs(): array
    {
        return $this->extraWithAvgs;
    }

    public function getComputedPropertiesStatus(): bool
    {
        return $this->useComputedProperties ?? false;
    }
}
