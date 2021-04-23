<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Illuminate\Database\Eloquent\Builder;

/**
 * Trait WithBulkActions.
 */
trait WithBulkActions
{
    public string $primaryKey = 'id';
    public bool $showFilters = true;
    public bool $selectPage = false;
    public bool $selectAll = false;
    public $selected = [];
    public array $bulkActions = [];

    public function renderingWithBulkActions(): void
    {
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

    public function selectedRowsQuery(): Builder
    {
        return (clone $this->rowsQuery())
            ->unless($this->selectAll, fn ($query) => $query->whereKey($this->selected));
    }

    public function getSelectedRowsQueryProperty(): Builder
    {
        return $this->selectedRowsQuery();
    }

    public function selectedKeys(): array
    {
        return $this->selectedRowsQuery()->pluck($this->primaryKey)->toArray();
    }

    public function getSelectedKeysProperty(): array
    {
        return $this->selectedKeys();
    }
}
