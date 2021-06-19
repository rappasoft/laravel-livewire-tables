<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

/**
 * Trait EWithDragAndDrop.
 */
trait WithReordering
{
    public ?string $reorderRows = null;
    public string $orderColumn = 'sort';
    public string $orderColumnDirection = 'asc';

    public function mountWithReordering(): void
    {
        if (is_string($this->reorderRows)) {
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
        }
    }
}
