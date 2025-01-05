<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Helpers;

use Livewire\Attributes\Computed;

trait ToolsHelpers
{
    public function getToolsStatus(): bool
    {
        return $this->toolsStatus;
    }

    public function getToolBarStatus(): bool
    {
        return $this->toolBarStatus;
    }

    #[Computed]
    public function shouldShowTools(): bool
    {
        if ($this->getToolsStatus()) {
            if ($this->shouldShowToolBar()) {
                return true;
            } else {
                if ($this->showSortPillsSection()) { // Sort Pills Are Enabled
                    return true;
                } elseif ($this->showFilterPillsSection()) { // Filter Pills Are Enable)
                    return true;
                } else {
                    return false;
                }
            }
        } else {
            return false;
        }
    }

    #[Computed]
    public function shouldShowToolBar(): bool
    {
        if ($this->getToolsStatus() == false) {
            return false;
        }

        if ($this->getToolBarStatus()) {
            if (
                $this->hasToolbarConfigurableAreas() || // Has Configured Toolbar Configurable Areas
                $this->hasToolbarActions() ||  // Actions Exist In Toolbar
                $this->hasToolbarReorder() ||  // If Reorder Is Enabled
                $this->hasToolbarColumnSelect() || // Column Select Enabled
                $this->displayToolbarSearch() || // If Search Is Enabled
                $this->displayToolbarFilters() ||  // If Filters Are Enabled
                $this->displayToolbarPagination()  // Pagination Selection Is Enabled
            ) {
                return true;
            }

            return false;
        }

        return false;
    }

    #[Computed]
    public function displayToolbarPagination(): bool
    {
        return $this->paginationIsEnabled() && $this->perPageVisibilityIsEnabled();
    }

    #[Computed]
    public function displayToolbarSearch(): bool
    {
        return $this->searchIsEnabled() && $this->searchVisibilityIsEnabled();
    }

    #[Computed]
    public function displayToolbarFilters(): bool
    {
        return $this->filtersAreEnabled() && (($this->filtersVisibilityIsEnabled() && $this->hasVisibleFilters()) || ($this->showBulkActionsDropdownAlpine() && $this->shouldAlwaysHideBulkActionsDropdownOption() != true));
    }

    protected function hasToolbarColumnSelect(): bool
    {
        return $this->columnSelectIsEnabled();
    }

    protected function hasToolbarReorder(): bool
    {
        return $this->reorderIsEnabled();
    }

    protected function hasToolbarConfigurableAreas(): bool
    {
        return $this->hasConfigurableAreaFor('toolbar-left-end') || $this->hasConfigurableAreaFor('toolbar-left-start') || $this->hasConfigurableAreaFor('toolbar-right-start') || $this->hasConfigurableAreaFor('toolbar-right-end');
    }

    protected function hasToolbarActions(): bool
    {
        return $this->hasActions() && $this->showActionsInToolbar();
    }
}
