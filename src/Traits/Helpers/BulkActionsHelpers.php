<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Helpers;

trait BulkActionsHelpers
{
    /**
     * @return bool
     */
    public function getBulkActionsStatus(): bool
    {
        return $this->bulkActionsStatus;
    }

    /**
     * @return bool
     */
    public function bulkActionsAreEnabled(): bool
    {
        return $this->getBulkActionsStatus() === true;
    }

    /**
     * @return bool
     */
    public function bulkActionsAreDisabled(): bool
    {
        return $this->getBulkActionsStatus() === false;
    }

    /**
     * @return bool
     */
    public function getSelectAllStatus(): bool
    {
        return $this->selectAll;
    }

    /**
     * @return bool
     */
    public function selectAllIsEnabled(): bool
    {
        return $this->getSelectAllStatus() === true;
    }

    /**
     * @return bool
     */
    public function selectAllIsDisabled(): bool
    {
        return $this->getSelectAllStatus() === false;
    }

    /**
     * @return bool
     */
    public function getHideBulkActionsWhenEmptyStatus(): bool
    {
        return $this->hideBulkActionsWhenEmpty;
    }

    /**
     * @return bool
     */
    public function hideBulkActionsWhenEmptyIsEnabled(): bool
    {
        return $this->getHideBulkActionsWhenEmptyStatus() === true;
    }

    /**
     * @return bool
     */
    public function hideBulkActionsWhenEmptyIsDisabled(): bool
    {
        return $this->getHideBulkActionsWhenEmptyStatus() === false;
    }

    /**
     * @return bool
     */
    public function hasBulkActions(): bool
    {
        return count($this->bulkActions());
    }

    /**
     * @return array
     */
    public function getBulkActions(): array
    {
        return $this->bulkActions();
    }

    /**
     * @return bool
     */
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
     * @param  array  $selected
     *
     * @return array
     */
    public function setSelected(array $selected): array
    {
        return $this->selected = $selected;
    }

    /**
     * @return array
     */
    public function getSelected(): array
    {
        return $this->selected;
    }

    /**
     * @return bool
     */
    public function hasSelected(): bool
    {
        return $this->getSelectedCount();
    }

    /**
     * @return int
     */
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
     * Disable select all when the selected array is updated
     */
    public function updatedSelected(): void
    {
        $this->setSelectAllDisabled();
    }

    /**
     * Clear or select all depending on what's selected when select all is changed
     */
    public function updatedSelectAll(): void
    {
        if (count($this->getSelected()) === (clone $this->baseQuery())->pluck($this->getPrimaryKey())->count()) {
            $this->clearSelected();
        } else {
            $this->setAllSelected();
        }
    }

    /**
     * Set select all and get all ids for selected
     */
    public function setAllSelected(): void
    {
        $this->setSelectAllEnabled();
        $this->setSelected((clone $this->baseQuery())->pluck($this->getPrimaryKey())->map(fn ($item) => (string)$item)->toArray());
    }
}
