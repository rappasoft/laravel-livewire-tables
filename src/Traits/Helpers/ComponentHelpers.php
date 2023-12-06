<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Helpers;

use Illuminate\Database\Eloquent\Builder;

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

    public function isTailwind(): bool
    {
        return $this->getTheme() === 'tailwind';
    }

    public function isBootstrap(): bool
    {
        return $this->getTheme() === 'bootstrap-4' || $this->getTheme() === 'bootstrap-5';
    }

    public function isBootstrap4(): bool
    {
        return $this->getTheme() === 'bootstrap-4';
    }

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

    public function getTableName(): string
    {
        return $this->tableName;
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
}
