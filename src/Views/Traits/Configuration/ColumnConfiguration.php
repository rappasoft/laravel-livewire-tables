<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Configuration;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

trait ColumnConfiguration
{
    /**
     * @param DataTableComponent $component
     *
     * @return self
     */
    public function setComponent(DataTableComponent $component): self
    {
        $this->component = $component;

        return $this;
    }

    /**
     * @param callable $callback
     *
     * @return self
     */
    public function label(callable $callback): self
    {
        $this->from = null;
        $this->field = null;
        $this->labelCallback = $callback;

        return $this;
    }

    /**
     * @param callable|null $callback
     *
     * @return self
     */
    public function sortable(callable $callback = null): self
    {
        $this->sortable = true;

        $this->sortCallback = $callback;

        return $this;
    }

    /**
     * @param callable $callable
     *
     * @return Column
     */
    public function format(callable $callable): Column
    {
        $this->formatCallback = $callable;

        return $this;
    }

    /**
     * @param callable|null $callback
     *
     * @return self
     */
    public function searchable(callable $callback = null): self
    {
        $this->searchable = true;

        $this->searchCallback = $callback;

        return $this;
    }

    /**
     * @return self
     */
    public function html(): self
    {
        $this->html = true;

        return $this;
    }

    /**
     * @param string $table
     *
     * @return self
     */
    public function setTable(string $table): self
    {
        $this->table = $table;

        return $this;
    }

    /**
     * @param string $title
     *
     * @return self
     */
    public function setSortingPillTitle(string $title): self
    {
        $this->sortingPillTitle = $title;

        return $this;
    }

    /**
     * @param string $asc
     * @param string $desc
     *
     * @return self
     */
    public function setSortingPillDirections(string $asc, string $desc): self
    {
        $this->sortingPillDirectionAsc = $asc;
        $this->sortingPillDirectionDesc = $desc;

        return $this;
    }

    /**
     * @return self
     */
    public function eagerLoadRelations(): self
    {
        $this->eagerLoadRelations = true;

        return $this;
    }

    /**
     * @param mixed $condition
     *
     * @return self
     */
    public function hideIf($condition): self
    {
        $this->hidden = $condition;

        return $this;
    }

    /**
     * @return self
     */
    public function excludeFromColumnSelect(): self
    {
        $this->selectable = false;

        return $this;
    }

    /**
     * @return self
     */
    public function deselected(): self
    {
        $this->selected = false;

        return $this;
    }

    /**
     * @param  mixed  $callback
     *
     * @return self
     */
    public function secondaryHeader($callback = null): self
    {
        $this->secondaryHeader = true;

        $this->secondaryHeaderCallback = $callback;

        return $this;
    }

    /**
     * @param string $filterKey
     *
     * @return self
     */
    public function secondaryHeaderFilter(string $filterKey): self
    {
        $this->secondaryHeader = true;

        $this->secondaryHeaderCallback = $filterKey;

        return $this;
    }

    /**
     * @param  mixed  $callback
     *
     * @return self
     */
    public function footer($callback = null): self
    {
        $this->footer = true;

        $this->footerCallback = $callback;

        return $this;
    }

    /**
     * @param string $filterKey
     *
     * @return self
     */
    public function footerFilter(string $filterKey): self
    {
        $this->footer = true;

        $this->footerCallback = $filterKey;

        return $this;
    }

    /**
     * @return self
     */
    public function unclickable(): self
    {
        $this->clickable = false;

        return $this;
    }

    /**
     * @param string $customSlug
     *
     * @return self
     */
    public function setCustomSlug(string $customSlug): self
    {
        $this->customSlug = $customSlug;

        return $this;
    }
}
