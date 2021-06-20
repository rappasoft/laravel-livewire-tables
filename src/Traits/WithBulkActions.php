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
    public $selected = [];
    public array $bulkActions = [];

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
        $this->selected = $this->rows->pluck($this->primaryKey)->map(fn ($key) => (string) $key);
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
        return (clone $this->rowsQuery())
            ->unless($this->selectAll, fn ($query) => $query->whereIn($query->qualifyColumn($this->primaryKey), $this->selected));
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
        return $this->selectedRowsQuery()->pluck($this->rowsQuery()->qualifyColumn($this->primaryKey))->toArray();
    }

    public function getSelectedKeysProperty(): array
    {
        return $this->selectedKeys();
    }
}
