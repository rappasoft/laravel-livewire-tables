<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Columns;

use Closure;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\{Column,Filter};

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

    public function getSortCallback(): ?callable
    {
        return $this->sortCallback;
    }

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

    public function getCustomSortingPillDirections(string $direction): string
    {
        if ($direction === 'asc') {
            return $this->sortingPillDirectionAsc;
        }

        if ($direction === 'desc') {
            return $this->sortingPillDirectionDesc;
        }

        return __('N/A');
    }

    public function getSortingPillDirection(DataTableComponent $component, string $direction): string
    {
        if ($this->hasCustomSortingPillDirections()) {
            return $this->getCustomSortingPillDirections($direction);
        }

        return $direction === 'asc' ? $component->getDefaultSortingLabelAsc() : $component->getDefaultSortingLabelDesc();
    }
}
