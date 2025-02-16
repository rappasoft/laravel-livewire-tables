<?php

namespace Rappasoft\LaravelLivewireTables\Views\Columns\Traits\Configuration;

trait ColumnConfiguration
{
    public function html(): self
    {
        $this->html = true;

        return $this;
    }

    public function setTable(string $table): self
    {
        $this->table = $table;

        return $this;
    }

    public function setIndexes(int $rowIndex, int $columnIndex): self
    {
        $this->setRowIndex($rowIndex);
        $this->setColumnIndex($columnIndex);

        return $this;
    }

    public function setColumnIndex(int $columnIndex): self
    {
        $this->columnIndex = $columnIndex;

        return $this;
    }

    public function setRowIndex(int $rowIndex): self
    {
        $this->rowIndex = $rowIndex;

        return $this;
    }
}
