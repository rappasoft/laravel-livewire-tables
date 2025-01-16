<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Helpers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\View\ComponentAttributeBag;
use Livewire\Attributes\Computed;
use Rappasoft\LaravelLivewireTables\Views\Column;

trait TableAttributeHelpers
{
    #[Computed]
    public function getComponentWrapperAttributes(): array
    {
        return count($this->componentWrapperAttributes) ? $this->componentWrapperAttributes : ['id' => 'datatable-'.$this->getId()];
    }

    #[Computed]
    public function getTableWrapperAttributes(): array
    {
        return count($this->tableWrapperAttributes) ? $this->tableWrapperAttributes : ['default' => true];
    }

    #[Computed]
    public function getTableAttributes(): array
    {
        return count($this->tableAttributes) ? $this->tableAttributes : ['id' => 'table-'.$this->getTableName(), 'default' => true];
    }

    #[Computed]
    public function getTheadAttributes(): array
    {
        return count($this->theadAttributes) ? $this->theadAttributes : ['default' => true];
    }

    #[Computed]
    public function getTbodyAttributes(): array
    {
        return count($this->tbodyAttributes) ? $this->tbodyAttributes : ['default' => true];
    }

    /**
     * Used in resources/views/components/table/th.blade.php
     */
    #[Computed]
    public function getThAttributes(Column $column): array
    {

        if (isset($this->thAttributesCallback)) {
            return array_merge(['scope' => 'col', 'default' => false, 'default-colors' => false, 'default-styling' => false], call_user_func($this->thAttributesCallback, $column));
        }

        return ['default' => true, 'default-colors' => true, 'default-styling' => true];
    }

    /**
     * Used in resources/views/components/table/th.blade.php
     */
    #[Computed]
    public function getThSortButtonAttributes(Column $column): array
    {
        if (isset($this->thSortButtonAttributesCallback)) {
            return array_merge(['default' => false, 'default-colors' => false, 'default-styling' => false], call_user_func($this->thSortButtonAttributesCallback, $column));
        }

        return ['default' => true, 'default-colors' => true, 'default-styling' => true];
    }

    /**
     * Used in resources/views/components/table/th.blade.php
     */
    #[Computed]
    public function getThSortIconAttributes(Column $column): array
    {
        if (isset($this->thSortIconAttributesCallback)) {
            return array_merge(['default' => false, 'default-colors' => false, 'default-styling' => false], call_user_func($this->thSortIconAttributesCallback, $column));
        }

        return ['default' => true, 'default-colors' => true, 'default-styling' => true];
    }

    /**
     * Used in resources/views/components/table/th.blade.php
     */
    #[Computed]
    public function getAllThAttributes(Column $column): array
    {
        return [
            'customAttributes' => $this->getThAttributes($column),
            'labelAttributes' => $column->getLabelAttributesBag(),
            'sortButtonAttributes' => $this->getThSortButtonAttributes($column),
            'sortIconAttributes' => $this->getThSortIconAttributes($column),
        ];
    }

    #[Computed]
    public function getTrAttributes(Model $row, int $index): array
    {
        return isset($this->trAttributesCallback) ? call_user_func($this->trAttributesCallback, $row, $index) : ['default' => true];
    }

    #[Computed]
    public function getTdAttributes(Column $column, Model $row, int $colIndex, int $rowIndex): array
    {
        return isset($this->tdAttributesCallback) ? call_user_func($this->tdAttributesCallback, $column, $row, $colIndex, $rowIndex) : ['default' => true];
    }

    public function hasTableRowUrl(): bool
    {
        return isset($this->trUrlCallback);
    }

    public function getTableRowUrl(int|Model $row): ?string
    {
        return isset($this->trUrlCallback) ? call_user_func($this->trUrlCallback, $row) : null;
    }

    public function getTableRowUrlTarget(int|Model $row): ?string
    {
        return isset($this->trUrlTargetCallback) ? call_user_func($this->trUrlTargetCallback, $row) : null;
    }

    #[Computed]
    public function getShouldBeDisplayed(): bool
    {
        return $this->shouldBeDisplayed;
    }

    public function getTopLevelAttributesArray(): array
    {
        return [
            'x-data' => 'laravellivewiretable($wire)',
            'x-init' => "setTableId('".$this->getTableAttributes()['id']."'); setAlpineBulkActions('".$this->showBulkActionsDropdownAlpine()."'); setPrimaryKeyName('".$this->getPrimaryKey()."');",
            'x-cloak',
            'x-show' => 'shouldBeDisplayed',
            'x-on:show-table.window' => 'showTable(event)',
            'x-on:hide-table.window' => 'hideTable(event)',
        ];
    }

    #[Computed]
    public function getTopLevelAttributes(): ComponentAttributeBag
    {
        return new ComponentAttributeBag($this->getTopLevelAttributesArray());
    }
}
