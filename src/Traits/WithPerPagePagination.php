<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

/**
 * Trait WithPerPagePagination.
 */
trait WithPerPagePagination
{
    /**
     * @var bool
     */
    public bool $pagination = true;

    /**
     * @var int
     */
    public int $perPage = 10;

    /**
     * @var array|int[]
     */
    protected array $perPageAccepted = [10, 25, 50];

    public function mountWithPerPagePagination(): void
    {
        if ($this->pagination === false) {
            // do nothing if disabled
        } elseif (in_array(session()->get($this->tableName.'-perPage', $this->perPage), $this->perPageAccepted, true)) {
            $this->perPage = session()->get($this->tableName.'-perPage', $this->perPage);
        } else {
            $this->perPage = 10;
        }
    }

    public function updatedPerPage($value): void
    {
        if ($this->pagination === false) {
            // do nothing if disabled
        } elseif (in_array(session()->get($this->tableName.'-perPage', $this->perPage), $this->perPageAccepted, true)) {
            session()->put($this->tableName.'-perPage', (int) $value);
        } else {
            session()->put($this->tableName.'-perPage', 10);
        }
    }

    /**
     * Apply pagination to the query
     *
     * @param Builder $query
     * @return Collection|LengthAwarePaginator
     */
    public function applyPagination(Builder $query) : mixed
    {
        if ($this->pagination === false) {
            return $query->get();
        } else {
            return $query->paginate($this->perPage, ['*'], $this->pageName());
        }
    }
}
