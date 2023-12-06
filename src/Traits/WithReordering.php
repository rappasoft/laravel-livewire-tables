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

    public bool $reorderDisplayColumn = false;

    public string $reorderMethod = 'reorder';

    public string $defaultReorderColumn = 'sort';

    public string $defaultReorderDirection = 'asc';

    public array $orderedItems = [];

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

    public function enablePaginatedReordering(): void
    {

    }

    public function enableReordering(): void
    {
        //$this->enablePaginatedReordering();

        $this->setReorderingSession();
        $this->setReorderingBackup();
        $this->resetReorderFields();
        $this->reorderStatus = $this->currentlyReorderingStatus = $this->reorderDisplayColumn = true;

    }

    public function disableReordering(): void
    {

        $this->forgetReorderingSession();
        $this->setCurrentlyReorderingDisabled();
        $this->getReorderingBackup();
        $this->currentlyReorderingStatus = $this->reorderDisplayColumn = false;

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
        session([$this->getReorderingBackupSessionKey() => $this->getTableStateToArray()]);
    }

    protected function getTableStateToArray(): array
    {
        return [
            $this->getTableName() => $this->{$this->getTableName()},
            'sorts' => $this->sorts,
            'search' => $this->search,
            'selectedColumns' => $this->selectedColumns,
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
        ];
    }

    protected function restoreStateFromArray(array $tableState): void
    {
        $this->{$this->getTableName()} = $tableState[$this->getTableName()];
        $this->sorts = $tableState['sorts'];
        $this->search = $tableState['search'];
        $this->selectedColumns = $tableState['selectedColumns'];
        $this->setSortingPillsStatus($tableState['sortingPillsStatus']);
        $this->setSortingStatus($tableState['sortingStatus']);
        $this->setPaginationStatus($tableState['paginationStatus']);
        $this->setPerPageVisibilityStatus($tableState['perPageVisibilityStatus']);
        $this->setPerPageAccepted($tableState['perPageAccepted']);
        $this->setPerPage($tableState['perPage']);
        $this->setPage($tableState['page'], $this->getComputedPageName());
        $this->setSearchStatus($tableState['searchStatus']);
        $this->setBulkActionsStatus($tableState['bulkActionsStatus']);
        $this->setSelected($tableState['selected']);
        $this->setSelectAllStatus($tableState['selectAllStatus']);
        $this->setFiltersStatus($tableState['filtersStatus']);
        $this->setSecondaryHeaderStatus($tableState['secondaryHeaderStatus']);
        $this->setFooterStatus($tableState['footerStatus']);
        $this->setCollapsingColumnsStatus($tableState['collapsingColumnsStatus']);

    }

    private function getReorderingBackup(): void
    {
        // TODO: Why won't secondary header and footer come back?
        if (session()->has($this->getReorderingBackupSessionKey())) {
            $this->restoreStateFromArray(session()->get($this->getReorderingBackupSessionKey()));
            session()->forget($this->getReorderingBackupSessionKey());
        }
        $this->currentlyReorderingStatus = $this->reorderDisplayColumn = false;

    }

    public function storeReorder(array $rows = []): void
    {
        $this->{$this->getReorderMethod()}($rows);
        $this->forgetReorderingSession();
        $this->getReorderingBackup();
    }

    public function renderingWithReordering(): void
    {
        $this->setupReordering();
    }
}
