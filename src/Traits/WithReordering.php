<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

/**
 * Trait WithReordering.
 */
trait WithReordering
{
    public bool $reorderEnabled = false;
    public bool $reordering = false;
    public string $reorderingMethod = 'reorder';

    public function mountWithReordering(): void
    {
        if (! $this->reorderEnabled && $this->hasReorderingSession()) {
            $this->forgetReorderingSession();
        }

        $this->setReorderingProperties();
    }

    public function enableReordering(): void
    {
        $this->setReorderingSession();
        $this->setReorderingProperties();
    }

    public function disableReordering(): void
    {
        $this->forgetReorderingSession();
        $this->setReorderingProperties();
    }

    private function setReorderingSession(): void
    {
        session([$this->getReorderingSessionKey() => true]);
    }

    private function forgetReorderingSession(): void
    {
        session()->forget($this->getReorderingSessionKey());
    }

    private function hasReorderingSession(): bool
    {
        return session()->has($this->getReorderingSessionKey());
    }

    private function setReorderingProperties(): void
    {
        if ($this->hasReorderingSession()) {
            $this->reordering = true;
            $this->bulkActionsEnabled = false;
            $this->selectPage = false;
            $this->selectAll = false;
            $this->selected = [];
            $this->showSorting = false;
            $this->sortingEnabled = false;
            $this->filtersEnabled = false;
            $this->sorts = [];
            $this->filters = [];
            $this->showPagination = false;
            $this->showPerPage = false;
            $this->showSearch = false;
            $this->perPageAll = true;
            $this->perPage = -1;
            $this->resetPage();
        } else {
            $this->reordering = false;
            $this->reset([
                'bulkActionsEnabled',
                'selectPage',
                'selectAll',
                'selected',
                'showSorting',
                'sortingEnabled',
                'filtersEnabled',
                'sorts',
                'filters',
                'showPagination',
                'showPerPage',
                'showSearch',
                'perPageAll',
                'perPage',
            ]);
        }
    }

    private function getReorderingSessionKey(): string
    {
        return $this->tableName.'-reordering';
    }
}
