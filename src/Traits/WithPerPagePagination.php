<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

/**
 * Trait WithPerPagePagination.
 */
trait WithPerPagePagination
{
    public int $perPage = 10;
    protected array $perPageAccepted = [10, 25, 50];

    public function mountWithPerPagePagination(): void
    {
        if (in_array(session()->get($this->tableName.'-perPage', $this->perPage), $this->perPageAccepted, true)) {
            $this->perPage = session()->get($this->tableName.'-perPage', $this->perPage);
        } else {
            $this->perPage = 10;
        }
    }

    public function updatedPerPage($value): void
    {
        if (in_array(session()->get($this->tableName.'-perPage', $this->perPage), $this->perPageAccepted, true)) {
            session()->put($this->tableName.'-perPage', (int) $value);
        } else {
            session()->put($this->tableName.'-perPage', 10);
        }
    }

    public function applyPagination($query)
    {
        return $query->paginate($this->perPage, ['*'], $this->pageName());
    }
}
