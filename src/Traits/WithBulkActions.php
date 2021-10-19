<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;

/**
 * Trait WithBulkActions.
 */
trait WithBulkActions
{
    public bool $bulkActionsEnabled = true;
    public string $primaryKey = 'id';
    public bool $selectPage = false;
    public bool $selectAll = false;
    public array $selected = [];
    public bool $hideBulkActionsOnEmpty = false;

    public function renderingWithBulkActions(): void
    {
        if (! $this->bulkActionsEnabled) {
            return;
        }

        if ($this->selectAll) {
            $this->selectPageRows();
        }
    }

    public function updatedSelected(): void
    {
        $this->selectAll = false;
        $this->selectPage = false;
    }

    public function updatedSelectPage($value): void
    {
        if ($value) {
            $this->selectPageRows();

            return;
        }

        $this->selectAll = false;
        $this->selected = [];
    }

    public function selectPageRows(): void
    {
        $this->selected = $this->rows->pluck($this->primaryKey)->map(fn ($key) => (string) $key)->toArray();
    }

    public function selectAll(): void
    {
        $this->selectAll = true;
    }

    public function resetBulk(): void
    {
        $this->selectPage = false;
        $this->selectAll = false;
        $this->selected = [];
    }

    /**
     * @return Builder|Relation
     */
    public function selectedRowsQuery()
    {
        return $this->query()->unless(
            $this->selectAll,
            fn ($query) => $query->whereIn($query->qualifyColumn($this->primaryKey), $this->selected)
        );
    }

    /**
     * @return Builder|Relation
     */
    public function getSelectedRowsQueryProperty()
    {
        return $this->selectedRowsQuery();
    }

    public function selectedKeys(): array
    {
        return $this->selectedRowsQuery()->pluck($this->query()->qualifyColumn($this->primaryKey))->toArray();
    }

    public function getSelectedKeysProperty(): array
    {
        return $this->selectedKeys();
    }

    public function getBulkActionsProperty(): array
    {
        return $this->bulkActions();
    }

    public function bulkActions(): array
    {
        if (property_exists($this, 'bulkActions')) {
            return $this->bulkActions;
        }

        return [];
    }

    public function getShowBulkActionsDropdownProperty(): bool
    {
        $showBulkActions = false;

        if ($this->bulkActionsEnabled) {
            if (count($this->bulkActions())) {
                $showBulkActions = true;
            }

            if ($this->hideBulkActionsOnEmpty) {
                if (count($this->selected)) {
                    $showBulkActions = true;
                } else {
                    $showBulkActions = false;
                }
            }
        }

        return $showBulkActions;
    }
}
