<?php

namespace Rappasoft\LaravelLivewireTables\Views\Columns\Traits;

use Rappasoft\LaravelLivewireTables\DataTableComponent;

trait IsSortable
{
    protected bool $sortable = false;

    protected mixed $sortCallback = null;

    protected ?string $sortingPillTitle = null;

    protected ?string $sortingPillDirectionAsc = null;

    protected ?string $sortingPillDirectionDesc = null;

    public function sortable(?callable $callback = null): self
    {
        $this->sortable = true;

        $this->sortCallback = $callback;

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

    /**
     * Used internally
     * Used in resources/views/components/table/th.blade.php
     */
    public function getSortCallback(): ?callable
    {
        return $this->sortCallback;
    }

    /**
     * Used internally
     * Used in resources/views/components/table/th.blade.php
     */
    public function isSortable(): bool
    {
        return $this->hasField() && $this->sortable === true;
    }

    public function hasSortCallback(): bool
    {
        return $this->sortCallback !== null;
    }

    public function getSortingPillTitle(): string
    {
        if ($this->hasCustomSortingPillTitle()) {
            return $this->getCustomSortingPillTitle();
        }

        return $this->getTitle();
    }

    public function getCustomSortingPillTitle(): ?string
    {
        return $this->sortingPillTitle;
    }

    public function hasCustomSortingPillTitle(): bool
    {
        return $this->getCustomSortingPillTitle() !== null;
    }

    public function hasCustomSortingPillDirections(): bool
    {
        return $this->sortingPillDirectionAsc !== null && $this->sortingPillDirectionDesc !== null;
    }

    public function getCustomSortingPillDirections(string $direction, ?string $defaultLabelAsc = 'A-Z', ?string $defaultLabelDesc = 'Z-A'): string
    {
        if ($direction === 'asc') {
            return $this->sortingPillDirectionAsc ?? $defaultLabelAsc;
        }

        if ($direction === 'desc') {
            return $this->sortingPillDirectionDesc ?? $defaultLabelDesc;
        }

        return __($this->getLocalisationPath().'not_applicable');
    }

    public function getCustomSortingPillDirectionsLabel(string $direction, ?string $defaultLabelAsc = 'A-Z', ?string $defaultLabelDesc = 'Z-A'): string
    {
        if ($direction === 'asc') {
            return $this->sortingPillDirectionAsc ?? $defaultLabelAsc;
        }

        if ($direction === 'desc') {
            return $this->sortingPillDirectionDesc ?? $defaultLabelDesc;
        }

        return __($this->getLocalisationPath().'not_applicable');
    }

    public function getSortingPillDirection(DataTableComponent $component, string $direction): string
    {
        if ($this->hasCustomSortingPillDirections()) {
            return $this->getCustomSortingPillDirections($direction, $component->getDefaultSortingLabelAsc(), $component->getDefaultSortingLabelDesc());
        }

        return $direction === 'asc' ? $component->getDefaultSortingLabelAsc() : $component->getDefaultSortingLabelDesc();
    }

    public function getSortingPillDirectionLabel(string $direction, ?string $defaultLabelAsc = 'A-Z', ?string $defaultLabelDesc = 'Z-A'): string
    {
        if ($this->hasCustomSortingPillDirections()) {
            return $this->getCustomSortingPillDirectionsLabel($direction, $defaultLabelAsc, $defaultLabelDesc);
        }

        return $direction === 'asc' ? $defaultLabelAsc : $defaultLabelDesc;
    }

    /**
     * Used in resources/views/components/table/th.blade.php
     */
    public function getColumnSortKey(): string
    {
        return $this->isSortable() ? $this->getColumnSelectName() : $this->getSlug();
    }
}
