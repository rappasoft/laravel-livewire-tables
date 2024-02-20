<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Helpers;

use Illuminate\Database\Eloquent\Model;
use Rappasoft\LaravelLivewireTables\Views\Column;

trait TableAttributeHelpers
{
    /**
     * @return array<mixed>
     */
    public function getComponentWrapperAttributes(): array
    {
        return count($this->componentWrapperAttributes) ? $this->componentWrapperAttributes : ['id' => 'datatable-'.$this->getId()];
    }

    /**
     * @return array<mixed>
     */
    public function getTableWrapperAttributes(): array
    {
        return count($this->tableWrapperAttributes) ? $this->tableWrapperAttributes : ['default' => true];
    }

    /**
     * @return array<mixed>
     */
    public function getTableAttributes(): array
    {
        return count($this->tableAttributes) ? $this->tableAttributes : ['id' => 'table-'.$this->getTableName(), 'default' => true];
    }

    /**
     * @return array<mixed>
     */
    public function getTheadAttributes(): array
    {
        return count($this->theadAttributes) ? $this->theadAttributes : ['default' => true];
    }

    /**
     * @return array<mixed>
     */
    public function getTbodyAttributes(): array
    {
        return count($this->tbodyAttributes) ? $this->tbodyAttributes : ['default' => true];
    }

    /**
     * @return array<mixed>
     */
    public function getThAttributes(Column $column): array
    {
        return $this->thAttributesCallback ? call_user_func($this->thAttributesCallback, $column) : ['default' => true];
    }

    /**
     * @return array<mixed>
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
}
