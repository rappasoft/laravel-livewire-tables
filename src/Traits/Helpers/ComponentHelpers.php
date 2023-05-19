<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Helpers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Rappasoft\LaravelLivewireTables\Views\Column;

trait ComponentHelpers
{
    public function getDataTableFingerprint(): string
    {
        return $this->dataTableFingerprint ?? $this->generateDataTableFingerprint();
    }

    public function getQueryStringAlias(): string
    {
        return $this->queryStringAlias ?? $this->getTableName();
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
        return $this->primaryKey !== null;
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

    /**
     * @return array<mixed>
     */
    public function getComponentWrapperAttributes(): array
    {
        return count($this->componentWrapperAttributes) ? $this->componentWrapperAttributes : ['id' => 'datatable-'.$this->id];
    }

    /**
     * @return  array<mixed>
     */
    public function getTableWrapperAttributes(): array
    {
        return count($this->tableWrapperAttributes) ? $this->tableWrapperAttributes : ['default' => true];
    }

    /**
     * @return  array<mixed>
     */
    public function getTableAttributes(): array
    {
        return count($this->tableAttributes) ? $this->tableAttributes : ['default' => true];
    }

    /**
     * @return  array<mixed>
     */
    public function getTheadAttributes(): array
    {
        return count($this->theadAttributes) ? $this->theadAttributes : ['default' => true];
    }

    /**
     * @return  array<mixed>
     */
    public function getTbodyAttributes(): array
    {
        return count($this->tbodyAttributes) ? $this->tbodyAttributes : ['default' => true];
    }

    /**
     * @return  array<mixed>
     */
    public function getThAttributes(Column $column): array
    {
        return $this->thAttributesCallback ? call_user_func($this->thAttributesCallback, $column) : ['default' => true];
    }

    /**
     * @return  array<mixed>
     */
    public function getThSortButtonAttributes(Column $column): array
    {
        return $this->thSortButtonAttributesCallback ? call_user_func($this->thSortButtonAttributesCallback, $column) : ['default' => true];
    }

    /**
     * @return array<mixed>
     */
    public function getTrAttributes(Model $row, int $index): array
    {
        return $this->trAttributesCallback ? call_user_func($this->trAttributesCallback, $row, $index) : ['default' => true];
    }

    /**
     * @return array<mixed>
     */
    public function getTdAttributes(Column $column, Model $row, int $colIndex, int $rowIndex): array
    {
        return $this->tdAttributesCallback ? call_user_func($this->tdAttributesCallback, $column, $row, $colIndex, $rowIndex) : ['default' => true];
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

    public function getQueryStringStatus(): bool
    {
        return $this->queryStringStatus;
    }

    public function queryStringIsEnabled(): bool
    {
        return $this->getQueryStringStatus() === true;
    }

    public function queryStringIsDisabled(): bool
    {
        return $this->getQueryStringStatus() === false;
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

    public function getCollapsingColumnsStatus(): bool
    {
        return $this->collapsingColumnsStatus;
    }

    public function hasCollapsingColumns(): bool
    {
        return $this->getCollapsingColumnsStatus() === true;
    }

    public function collapsingColumnsAreEnabled(): bool
    {
        return $this->getCollapsingColumnsStatus() === true;
    }

    public function collapsingColumnsAreDisabled(): bool
    {
        return $this->getCollapsingColumnsStatus() === false;
    }

    public function hasTableRowUrl(): bool
    {
        return $this->trUrlCallback !== null;
    }

    public function getTableRowUrl($row): ?string
    {
        return $this->trUrlCallback ? call_user_func($this->trUrlCallback, $row) : null;
    }

    public function getTableRowUrlTarget($row): ?string
    {
        return $this->trUrlTargetCallback ? call_user_func($this->trUrlTargetCallback, $row) : null;
    }

    /**
     * @return array<mixed>
     */
    public function getAdditionalSelects(): array
    {
        return $this->additionalSelects;
    }

    /**
     * @return array<mixed>
     */
    public function getConfigurableAreas(): array
    {
        return $this->configurableAreas;
    }

    public function hasConfigurableAreaFor(string $area): bool
    {
        if ($this->hideConfigurableAreasWhenReorderingIsEnabled() && $this->reorderIsEnabled() && $this->currentlyReorderingIsEnabled()) {
            return false;
        }

        return isset($this->configurableAreas[$area]) && $this->getConfigurableAreaFor($area) !== null;
    }

    /**
     * @param  string|array<mixed>  $area
     */
    public function getConfigurableAreaFor($area): ?string
    {
        $area = $this->configurableAreas[$area] ?? null;

        if (is_array($area)) {
            return $area[0];
        }

        return $area;
    }

    /**
     * @param  string|array<mixed>  $area
     * @return array<mixed>
     */
    public function getParametersForConfigurableArea($area): array
    {
        $area = $this->configurableAreas[$area] ?? null;

        if (is_array($area) && isset($area[1]) && is_array($area[1])) {
            return $area[1];
        }

        return [];
    }

    public function getHideConfigurableAreasWhenReorderingStatus(): bool
    {
        return $this->hideConfigurableAreasWhenReorderingStatus;
    }

    public function hideConfigurableAreasWhenReorderingIsEnabled(): bool
    {
        return $this->getHideConfigurableAreasWhenReorderingStatus() === true;
    }

    public function hideConfigurableAreasWhenReorderingIsDisabled(): bool
    {
        return $this->getHideConfigurableAreasWhenReorderingStatus() === false;
    }
}
