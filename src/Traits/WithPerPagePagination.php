<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

/**
 * Trait WithPerPagePagination.
 */
trait WithPerPagePagination
{
    public bool $paginationEnabled = true;
    public bool $showPerPage = true;
    public bool $showPagination = true;
    public int $perPage = 10;
    public array $perPageAccepted = [10, 25, 50];
    public bool $perPageAll = false;

    public function mountWithPerPagePagination(): void
    {
        if ($this->perPageAll) {
            $this->perPageAccepted[] = -1;
        }

        if (in_array(session()->get($this->getPerPagePaginationSessionKey(), $this->perPage), $this->perPageAccepted, true)) {
            $this->perPage = session()->get($this->getPerPagePaginationSessionKey(), $this->perPage);
        } else {
            $this->perPage = $this->perPageAccepted[0] ?? 10;
        }
    }

    public function updatedPerPage($value): void
    {
        if (! in_array($value, $this->perPageAccepted, false)) {
            $value = $this->perPage = $this->perPageAccepted[0] ?? 10;
        }

        if (in_array(session()->get($this->getPerPagePaginationSessionKey(), $this->perPage), $this->perPageAccepted, true)) {
            session()->put($this->getPerPagePaginationSessionKey(), (int) $value);
        } else {
            session()->put($this->getPerPagePaginationSessionKey(), $this->perPageAccepted[0] ?? 10);
        }

        $this->resetPage($this->pageName());
    }

    public function applyPagination($query)
    {
        return $query->paginate($this->perPage === -1 ? $query->count() : $this->perPage, ['*'], $this->pageName());
    }

    private function getPerPagePaginationSessionKey(): string
    {
        return $this->tableName.'-perPage';
    }
}
