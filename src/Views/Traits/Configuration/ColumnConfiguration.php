<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Configuration;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

trait ColumnConfiguration
{
    public function setComponent(DataTableComponent $component): self
    {
        $this->component = $component;

        return $this;
    }

    public function label(callable $callback): self
    {
        $this->from = null;
        $this->field = null;
        $this->labelCallback = $callback;

        return $this;
    }

    public function format(callable $callable): Column
    {
        $this->formatCallback = $callable;

        return $this;
    }

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

    public function eagerLoadRelations(): self
    {
        $this->eagerLoadRelations = true;

        return $this;
    }

    public function unclickable(): self
    {
        $this->clickable = false;

        return $this;
    }

    public function setCustomSlug(string $customSlug): self
    {
        $this->customSlug = $customSlug;

        return $this;
    }

    public function setColumnLabelStatusDisabled(): self
    {
        $this->setColumnLabelStatus(false);

        return $this;
    }

    public function setColumnLabelStatusEnabled(): self
    {
        $this->setColumnLabelStatus(true);

        return $this;
    }

    public function setColumnLabelStatus(bool $status): void
    {
        $this->displayColumnLabel = $status;
    }
}
