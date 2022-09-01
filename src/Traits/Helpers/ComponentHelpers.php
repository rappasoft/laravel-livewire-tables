<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Helpers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Rappasoft\LaravelLivewireTables\Views\Column;

trait ComponentHelpers
{
    public function getDataTableFingerprint(): string
    {
        return $this->dataTableFingerprint ?? $this->dataTableFingerprint();
    }

    public function getQueryStringAlias(): string
    {
        return $this->queryStringAlias ?? $this->getTableName();
    }

    /**
     * @param Builder
     */
    public function setBuilder(Builder $builder): void
    {
        $this->builder = $builder;
    }

    /**
     * @return Builder
     */
    public function getBuilder(): Builder
    {
        return $this->builder;
    }

    /**
     * @return bool
     */
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
     * @return bool
     */
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
     * @return string
     */
    public function setTheme(): void
    {
        $theme = $this->getTheme();

        if ($theme === 'bootstrap-4' || $theme === 'bootstrap-5') {
            $this->setPaginationTheme('bootstrap');
        }
    }

    /**
     * @return string
     */
    public function getTheme(): string
    {
        return $this->theme ?? config('livewire-tables.theme', 'tailwind');
    }

    /**
     * @return string[]
     */
    public function getComponentWrapperAttributes(): array
    {
        return count($this->componentWrapperAttributes) ? $this->componentWrapperAttributes : ['id' => 'datatable-' . $this->id];
    }

    /**
     * @return string[]
     */
    public function getTableWrapperAttributes(): array
    {
        return count($this->tableWrapperAttributes) ? $this->tableWrapperAttributes : ['default' => true];
    }

    /**
     * @return bool[]
     */
    public function getTableAttributes(): array
    {
        return count($this->tableAttributes) ? $this->tableAttributes : ['default' => true];
    }

    /**
     * @return bool[]
     */
    public function getTheadAttributes(): array
    {
        return count($this->theadAttributes) ? $this->theadAttributes : ['default' => true];
    }

    /**
     * @return bool[]
     */
    public function getTbodyAttributes(): array
    {
        return count($this->tbodyAttributes) ? $this->tbodyAttributes : ['default' => true];
    }

    /**
     * @param  Column  $column
     *
     * @return bool[]
     */
    public function getThAttributes(Column $column): array
    {
        return $this->thAttributesCallback ? call_user_func($this->thAttributesCallback, $column) : ['default' => true];
    }

    /**
     * @param  Column  $column
     *
     * @return bool[]
     */
    public function getThSortButtonAttributes(Column $column): array
    {
        return $this->thSortButtonAttributesCallback ? call_user_func($this->thSortButtonAttributesCallback, $column) : ['default' => true];
    }

    /**
     * @param  Model  $row
     * @param  int  $index
     *
     * @return bool[]
     */
    public function getTrAttributes(Model $row, int $index): array
    {
        return $this->trAttributesCallback ? call_user_func($this->trAttributesCallback, $row, $index) : ['default' => true];
    }

    /**
     * @param  Column  $column
     * @param  Model  $row
     * @param  int  $index
     *
     * @return bool[]
     */
    public function getTdAttributes(Column $column, Model $row, int $colIndex, int $rowIndex): array
    {
        return $this->tdAttributesCallback ? call_user_func($this->tdAttributesCallback, $column, $row, $colIndex, $rowIndex) : ['default' => true];
    }

    /**
     * Get the translated empty message of the table
     *
     * @return string
     */
    public function getEmptyMessage(): string
    {
        return __($this->emptyMessage);
    }

    /**
     * @return bool
     */
    public function getOfflineIndicatorStatus(): bool
    {
        return $this->offlineIndicatorStatus;
    }

    /**
     * @return bool
     */
    public function offlineIndicatorIsEnabled(): bool
    {
        return $this->getOfflineIndicatorStatus() === true;
    }

    /**
     * @return bool
     */
    public function offlineIndicatorIsDisabled(): bool
    {
        return $this->getOfflineIndicatorStatus() === false;
    }

    /**
     * @return bool
     */
    public function getQueryStringStatus(): bool
    {
        return $this->queryStringStatus;
    }

    /**
     * @return bool
     */
    public function queryStringIsEnabled(): bool
    {
        return $this->getQueryStringStatus() === true;
    }

    /**
     * @return bool
     */
    public function queryStringIsDisabled(): bool
    {
        return $this->getQueryStringStatus() === false;
    }

    /**
     * @param  string  $name
     *
     * @return string
     */
    public function setTableName(string $name): string
    {
        return $this->tableName = $name;
    }

    /**
     * @return string
     */
    public function getTableName(): string
    {
        return $this->tableName;
    }

    /**
     * @param  string  $name
     *
     * @return bool
     */
    public function isTableNamed(string $name): bool
    {
        return $this->tableName === $name;
    }

    /**
     * @return bool
     */
    public function getEagerLoadAllRelationsStatus(): bool
    {
        return $this->eagerLoadAllRelationsStatus;
    }

    /**
     * @return bool
     */
    public function eagerLoadAllRelationsIsEnabled(): bool
    {
        return $this->getEagerLoadAllRelationsStatus() === true;
    }

    /**
     * @return bool
     */
    public function eagerLoadAllRelationsIsDisabled(): bool
    {
        return $this->getEagerLoadAllRelationsStatus() === false;
    }

    /**
     * @param  string  $name
     *
     * @return string
     */
    public function getCollapsingColumnsStatus(): bool
    {
        return $this->collapsingColumnsStatus;
    }
    
    /**
     * @return bool
     */
    public function hasCollapsingColumns(): bool
    {
        return $this->getCollapsingColumnsStatus() === true;
    }

    /**
     * @return bool
     */
    public function collapsingColumnsAreEnabled(): bool
    {
        return $this->getCollapsingColumnsStatus() === true;
    }

    /**
     * @return bool
     */
    public function collapsingColumnsAreDisabled(): bool
    {
        return $this->getCollapsingColumnsStatus() === false;
    }

    /**
    * @return bool
    */
    public function hasTableRowUrl(): bool
    {
        return $this->trUrlCallback !== null;
    }

    /**
     * @param  $row
     *
     * @return ?string
     */
    public function getTableRowUrl($row): ?string
    {
        return $this->trUrlCallback ? call_user_func($this->trUrlCallback, $row) : null;
    }

    /**
     * @param  $row
     *
     * @return ?string
     */
    public function getTableRowUrlTarget($row): ?string
    {
        return $this->trUrlTargetCallback ? call_user_func($this->trUrlTargetCallback, $row) : null;
    }

    /**
     * @return array
     */
    public function getAdditionalSelects(): array
    {
        return $this->additionalSelects;
    }

    /**
     * @return array
     */
    public function getConfigurableAreas(): array
    {
        return $this->configurableAreas;
    }

    /**
     * @param  string  $area
     *
     * @return bool
     */
    public function hasConfigurableAreaFor(string $area): bool
    {
        if ($this->hideConfigurableAreasWhenReorderingIsEnabled() && $this->reorderIsEnabled() && $this->currentlyReorderingIsEnabled()) {
            return false;
        }

        return isset($this->configurableAreas[$area]) && $this->getConfigurableAreaFor($area) !== null;
    }

    /**
     * @param  string|array  $area
     *
     * @return string|null
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
     * @param  string|array  $area
     *
     * @return array
     */
    public function getParametersForConfigurableArea($area): array
    {
        $area = $this->configurableAreas[$area] ?? null;

        if (is_array($area) && isset($area[1]) && is_array($area[1])) {
            return $area[1];
        }

        return [];
    }

    /**
     * @return bool
     */
    public function getHideConfigurableAreasWhenReorderingStatus(): bool
    {
        return $this->hideConfigurableAreasWhenReorderingStatus;
    }

    /**
     * @return bool
     */
    public function hideConfigurableAreasWhenReorderingIsEnabled(): bool
    {
        return $this->getHideConfigurableAreasWhenReorderingStatus() === true;
    }

    /**
     * @return bool
     */
    public function hideConfigurableAreasWhenReorderingIsDisabled(): bool
    {
        return $this->getHideConfigurableAreasWhenReorderingStatus() === false;
    }
}
