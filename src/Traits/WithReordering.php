<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Rappasoft\LaravelLivewireTables\Traits\Configuration\ReorderingConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Helpers\ReorderingHelpers;

trait WithReordering
{
    use ReorderingConfiguration,
        ReorderingHelpers;

    public bool $reorderStatus = false;
    public bool $currentlyReorderingStatus = false;
    public bool $hideReorderColumnUnlessReorderingStatus = false;
    public string $reorderMethod = 'reorder';
    public string $defaultReorderColumn = 'sort';
    public string $defaultReorderDirection = 'asc';

    public function setupReordering(): void
    {
        if ($this->reorderIsDisabled()) {
            return;
        }

        // If reordering is disabled but the page has a reorder session, remove it
        if (! $this->reorderIsEnabled() && $this->hasReorderingSession()) {
            $this->forgetReorderingSession();
        }

        $this->restartReorderingIfNecessary();
    }

    public function enableReordering(): void
    {
        $this->setReorderingSession();
        $this->setCurrentlyReorderingEnabled();
        $this->setReorderingBackup();
        $this->resetReorderFields();
    }

    public function disableReordering(): void
    {
        $this->forgetReorderingSession();
        $this->setCurrentlyReorderingDisabled();
        $this->getReorderingBackup();
    }

    private function restartReorderingIfNecessary(): void
    {
        // If the page loads with the session, enable reordering
        // Also called in ComponentUtilities@hydrate
        if ($this->reorderIsEnabled() && $this->hasReorderingSession()) {
            $this->setCurrentlyReorderingEnabled();
            $this->resetReorderFields();
        }
    }

    private function resetReorderFields(): void
    {
        $this->{$this->getTableName()} = [];
        $this->setSortingPillsDisabled();
        $this->setSortingDisabled();
        $this->setPaginationDisabled();
        $this->setPerPageVisibilityDisabled();
        $this->setPerPageAccepted([-1]);
        $this->setPerPage(-1);
        $this->setSearchDisabled();
        $this->setBulkActionsDisabled();
        $this->clearSelected();
        $this->setFiltersDisabled();
        $this->setSecondaryHeaderDisabled();
        $this->setFooterDisabled();
        $this->setCollapsingColumnsDisabled();
        $this->resetComputedPage();
    }

    private function setReorderingBackup(): void
    {
        if (session()->has($this->getReorderingBackupSessionKey())) {
            session()->forget($this->getReorderingBackupSessionKey());
        }

        session([$this->getReorderingBackupSessionKey() => [
            $this->getTableName() => $this->{$this->getTableName()},
            'sortingPillsStatus' => $this->getSortingPillsStatus(),
            'sortingStatus' => $this->getSortingStatus(),
            'paginationStatus' => $this->getPaginationStatus(),
            'perPageVisibilityStatus' => $this->getPerPageVisibilityStatus(),
            'perPageAccepted' => $this->getPerPageAccepted(),
            'perPage' => $this->getPerPage(),
            'page' => $this->paginators[$this->getComputedPageName()] ?? 1,
            'searchStatus' => $this->getSearchStatus(),
            'bulkActionsStatus' => $this->getBulkActionsStatus(),
            'selected' => $this->getSelected(),
            'selectAllStatus' => $this->getSelectAllStatus(),
            'filtersStatus' => $this->getFiltersStatus(),
            'secondaryHeaderStatus' => $this->getSecondaryHeaderStatus(),
            'footerStatus' => $this->getFooterStatus(),
            'collapsingColumnsStatus' => $this->hasCollapsingColumns(),
        ]]);
    }

    private function getReorderingBackup(): void
    {
        // TODO: Why won't secondary header and footer come back?

        if (session()->has($this->getReorderingBackupSessionKey())) {
            $save = session()->get($this->getReorderingBackupSessionKey());
            $this->{$this->getTableName()} = $save[$this->getTableName()];
            $this->setSortingPillsStatus($save['sortingPillsStatus']);
            $this->setSortingStatus($save['sortingStatus']);
            $this->setPaginationStatus($save['paginationStatus']);
            $this->setPerPageVisibilityStatus($save['perPageVisibilityStatus']);
            $this->setPerPageAccepted($save['perPageAccepted']);
            $this->setPerPage($save['perPage']);
            $this->setPage($save['page'], $this->getComputedPageName());
            $this->setSearchStatus($save['searchStatus']);
            $this->setBulkActionsStatus($save['bulkActionsStatus']);
            $this->setSelected($save['selected']);
            $this->setSelectAllStatus($save['selectAllStatus']);
            $this->setFiltersStatus($save['filtersStatus']);
            $this->setSecondaryHeaderStatus($save['secondaryHeaderStatus']);
            $this->setFooterStatus($save['footerStatus']);
            $this->setCollapsingColumnsStatus($save['collapsingColumnsStatus']);
            session()->forget($this->getReorderingBackupSessionKey());
        }
    }
}
