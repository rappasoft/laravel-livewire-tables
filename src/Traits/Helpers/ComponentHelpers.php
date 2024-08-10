<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Helpers;

use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Computed;

trait ComponentHelpers
{
    public function getDataTableFingerprint(): string
    {
        return $this->dataTableFingerprint ?? $this->generateDataTableFingerprint();
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

    public function setTheme(): void
    {
        $theme = $this->getTheme();

        if ($theme === 'bootstrap-4' || $theme === 'bootstrap-5') {
            $this->setPaginationTheme('bootstrap');
        }
    }

    public function getTheme(): string
    {
        return $this->theme ?? config('livewire-tables.theme', 'tailwind');
    }

    #[Computed]
    public function isTailwind(): bool
    {
        return $this->getTheme() === 'tailwind';
    }

    #[Computed]
    public function isBootstrap(): bool
    {
        return $this->getTheme() === 'bootstrap-4' || $this->getTheme() === 'bootstrap-5';
    }

    #[Computed]
    public function isBootstrap4(): bool
    {
        return $this->getTheme() === 'bootstrap-4';
    }

    #[Computed]
    public function isBootstrap5(): bool
    {
        return $this->getTheme() === 'bootstrap-5';
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
        return $this->getTableAttributes()['id'];
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
}
