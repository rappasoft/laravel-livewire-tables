<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Helpers;

use Livewire\Attributes\Computed;
use Rappasoft\LaravelLivewireTables\Views\Column;

trait BulkActionsHelpers
{
    #[Computed]
    public function showBulkActionsSections(): bool
    {
        return $this->bulkActionsAreEnabled() && $this->hasBulkActions();
    }

    public function getBulkActionsStatus(): bool
    {
        return $this->bulkActionsStatus;
    }

    public function bulkActionsAreEnabled(): bool
    {
        return $this->getBulkActionsStatus() === true;
    }

    public function bulkActionsAreDisabled(): bool
    {
        return $this->getBulkActionsStatus() === false;
    }

    public function getSelectAllStatus(): bool
    {
        return $this->selectAll;
    }

    public function selectAllIsEnabled(): bool
    {
        return $this->getSelectAllStatus() === true;
    }

    public function selectAllIsDisabled(): bool
    {
        return $this->getSelectAllStatus() === false;
    }

    public function getHideBulkActionsWhenEmptyStatus(): bool
    {
        return $this->hideBulkActionsWhenEmpty;
    }

    public function hideBulkActionsWhenEmptyIsEnabled(): bool
    {
        return $this->getHideBulkActionsWhenEmptyStatus() === true;
    }

    public function hideBulkActionsWhenEmptyIsDisabled(): bool
    {
        return $this->getHideBulkActionsWhenEmptyStatus() === false;
    }

    public function hasBulkActions(): bool
    {
        return count($this->bulkActions()) > 0;
    }

    /**
     * @return array<mixed>
     */
    public function getBulkActions(): array
    {
        return $this->bulkActions();
    }

    public function showBulkActionsDropdown(): bool
    {
        $show = false;

        if ($this->bulkActionsAreEnabled()) {
            if ($this->hasBulkActions()) {
                $show = true;
            }

            if ($this->hideBulkActionsWhenEmptyIsEnabled()) {
                if ($this->hasSelected()) {
                    $show = true;
                } else {
                    $show = false;
                }
            }
        }

        return $show;
    }

    /**
     * @param  array<mixed>  $selected
     * @return array<mixed>
     */
    public function setSelected(array $selected): array
    {
        return $this->selected = $selected;
    }

    /**
     * @return array<mixed>
     */
    public function getSelected(): array
    {
        return $this->selected;
    }

    public function hasSelected(): bool
    {
        return $this->getSelectedCount() > 0;
    }

    public function getSelectedCount(): int
    {
        return count($this->getSelected());
    }

    /**
     * Clear the bulk selected and disable select all
     */
    public function clearSelected(): void
    {
        $this->setSelectAllDisabled();
        $this->setSelected([]);
    }

    /**
     * Disable select all when the selected array is updated - if DelaySelectAll is not enabled
     */
    public function updatedSelected(): void
    {
        if (! $this->getDelaySelectAllStatus()) {
            $this->setSelectAllDisabled();
        }
    }

    /**
     * Clear or select all depending on what's selected when select all is changed
     */
    /*public function updatedSelectAll(): void
    {
        if (count($this->getSelected()) === (clone $this->baseQuery())->pluck($this->getPrimaryKey())->count()) {
            $this->clearSelected();
        } else {
            $this->setAllSelected();
        }
    }*/

    /**
     * Set select all and get all ids for selected
     */
    public function setAllSelected(): void
    {
        $this->setSelectAllEnabled();
        $this->setSelected((clone $this->baseQuery())->pluck($this->getBuilder()->getModel()->getTable().'.'.$this->getPrimaryKey())->map(fn ($item) => (string) $item)->toArray());
    }

    public function showBulkActionsDropdownAlpine(): bool
    {
        return $this->bulkActionsAreEnabled() && $this->hasBulkActions();
    }

    public function getBulkActionConfirms(): array
    {
        return array_keys($this->bulkActionConfirms);
    }

    public function hasConfirmationMessage(string $bulkAction): bool
    {
        return isset($this->bulkActionConfirms[$bulkAction]);
    }

    public function getBulkActionConfirmMessage(string $bulkAction): string
    {
        return $this->bulkActionConfirms[$bulkAction] ?? $this->getBulkActionDefaultConfirmationMessage();
    }

    public function getBulkActionDefaultConfirmationMessage(): string
    {
        return isset($this->bulkActionConfirmDefaultMessage) ? $this->bulkActionConfirmDefaultMessage : __($this->getLocalisationPath().'Bulk Actions Confirm');
    }

    #[Computed]
    public function shouldAlwaysHideBulkActionsDropdownOption(): bool
    {
        return $this->alwaysHideBulkActionsDropdownOption ?? false;
    }

    public function getClearSelectedOnSearch(): bool
    {
        return $this->clearSelectedOnSearch ?? true;
    }

    public function getClearSelectedOnFilter(): bool
    {
        return $this->clearSelectedOnFilter ?? true;
    }

    public function getSelectedRows(): array
    {
        if ($this->getDelaySelectAllStatus() && $this->selectAllIsEnabled()) {
            return (clone $this->baseQuery())->select($this->getBuilder()->getModel()->getTable().'.'.$this->getPrimaryKey())->pluck($this->getBuilder()->getModel()->getTable().'.'.$this->getPrimaryKey())->map(fn ($item) => $item)->toArray();
        } else {
            return $this->selected;
        }
    }

    public function getDelaySelectAllStatus(): bool
    {
        return $this->delaySelectAll ?? false;
    }

    public function getBulkActionsColumn(): Column
    {
        return Column::make('bulkactions')->label(fn () => null);
    }
}
