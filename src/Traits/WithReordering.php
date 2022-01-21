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

            $this->setReorderingBackup();

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
            $this->secondaryHeader = false;
            $this->customFooter = false;
            $this->useHeaderAsFooter = false;
            $this->resetPage($this->pageName());
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
                'secondaryHeader',
                'customFooter',
                'useHeaderAsFooter',
            ]);

            $this->getReorderingBackup();
        }
    }

    private function getReorderingSessionKey(): string
    {
        return $this->tableName.'-reordering';
    }

    private function getReorderingBackupSessionKey(): string
    {
        return $this->tableName.'-reordering-backup';
    }

    private function setReorderingBackup(): void
    {
        if (session()->has($this->getReorderingBackupSessionKey())) {
            session()->forget($this->getReorderingBackupSessionKey());
        }

        session([$this->getReorderingBackupSessionKey() => [
            'bulkActionsEnabled' => $this->bulkActionsEnabled,
            'selectPage' => $this->selectPage,
            'selectAll' => $this->selectAll,
            'selected' => $this->selected,
            'showSorting' => $this->showSorting,
            'sortingEnabled' => $this->sortingEnabled,
            'filtersEnabled' => $this->filtersEnabled,
            'sorts' => $this->sorts,
            'filters' => $this->filters,
            'showPagination' => $this->showPagination,
            'showPerPage' => $this->showPerPage,
            'showSearch' => $this->showSearch,
            'perPageAll' => $this->perPageAll,
            'perPage' => $this->perPage,
            'page' => $this->page,
            'secondaryHeader' => $this->secondaryHeader,
            'customFooter' => $this->customFooter,
            'useHeaderAsFooter' => $this->useHeaderAsFooter,
        ]]);
    }

    private function getReorderingBackup(): void
    {
        if (session()->has($this->getReorderingBackupSessionKey())) {
            $save = session()->get($this->getReorderingBackupSessionKey());
            $this->bulkActionsEnabled = $save['bulkActionsEnabled'] ?? false;
            $this->selectPage = $save['selectPage'] ?? false;
            $this->selectAll = $save['selectAll'] ?? false;
            $this->selected = $save['selected'] ?? [];
            $this->showSorting = $save['showSorting'] ?? false;
            $this->sortingEnabled = $save['sortingEnabled'] ?? false;
            $this->filtersEnabled = $save['filtersEnabled'] ?? false;
            $this->sorts = $save['sorts'] ?? [];
            $this->filters = $save['filters'] ?? [];
            $this->showPagination = $save['showPagination'] ?? false;
            $this->showPerPage = $save['showPerPage'] ?? false;
            $this->showSearch = $save['showSearch'] ?? false;
            $this->perPageAll = $save['perPageAll'] ?? true;
            $this->perPage = $save['perPage'] ?? -1;
            $this->page = $save['page'] ?? 1;
            $this->secondaryHeader = $save['secondaryHeader'] ?? false;
            $this->customFooter = $save['customFooter'] ?? false;
            $this->useHeaderAsFooter = $save['useHeaderAsFooter'] ?? false;
            session()->forget($this->getReorderingBackupSessionKey());
        }
    }
}
