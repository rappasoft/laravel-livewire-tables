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

    public function sortable(callable $callback = null): self
    {
        $this->sortable = true;

        $this->sortCallback = $callback;

        return $this;
    }

    public function format(callable $callable): Column
    {
        $this->formatCallback = $callable;

        return $this;
    }

    public function searchable(callable $callback = null): self
    {
        $this->searchable = true;

        $this->searchCallback = $callback;

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

    public function setSortingPillTitle(string $title): self
    {
        $this->sortingPillTitle = $title;

        return $this;
    }

    public function setSortingPillDirections(string $asc, string $desc): self
    {
        $this->sortingPillDirectionAsc = $asc;
        $this->sortingPillDirectionDesc = $desc;

        return $this;
    }

    public function eagerLoadRelations(): self
    {
        $this->eagerLoadRelations = true;

        return $this;
    }

    /**
     * @param  mixed  $condition
     */
    public function hideIf($condition): self
    {
        $this->hidden = $condition;

        return $this;
    }

    public function excludeFromColumnSelect(): self
    {
        $this->selectable = false;

        return $this;
    }

    public function deselected(): self
    {
        $this->selected = false;

        return $this;
    }

    /**
     * @param  mixed  $callback
     */
    public function secondaryHeader($callback = null): self
    {
        $this->secondaryHeader = true;

        $this->secondaryHeaderCallback = $callback;

        return $this;
    }

    public function secondaryHeaderFilter(string $filterKey): self
    {
        $this->secondaryHeader = true;

        $this->secondaryHeaderCallback = $filterKey;

        return $this;
    }

    /**
     * @param  mixed  $callback
     */
    public function footer($callback = null): self
    {
        $this->footer = true;

        $this->footerCallback = $callback;

        return $this;
    }

    public function footerFilter(string $filterKey): self
    {
        $this->footer = true;

        $this->footerCallback = $filterKey;

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
}
