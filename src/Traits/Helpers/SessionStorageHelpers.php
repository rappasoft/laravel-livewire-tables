<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Helpers;

trait SessionStorageHelpers
{
    protected function getSessionStorageStatus(string $name): bool
    {
        return $this->sessionStorageStatus[$name] ?? false;
    }

    protected function getSessionStorageStatusFilters(): bool
    {
        return $this->getSessionStorageStatus('filters') ?? false;
    }

    protected function shouldStoreFiltersInSession(): bool
    {
        return $this->getSessionStorageStatus('filters');
    }

    protected function getFilterSessionKey(): string
    {
        return $this->getTableName().'-filter-backup';
    }


    public function storeFilterValues(): void
    {
        if($this->shouldStoreFiltersInSession())
        {
            if (session()->has($this->getFilterSessionKey())) {
                session()->forget($this->getFilterSessionKey());
            }
            session([$this->getFilterSessionKey() => $this->appliedFilters]);
        }
    }

    public function restoreFilterValues(): void
    {
        if(empty($this->filterComponents) || empty($this->appliedFilters))
        {
            if($this->shouldStoreFiltersInSession())
            {
                if (session()->has($this->getFilterSessionKey())) {
                    $this->filterComponents = $this->appliedFilters = session()->get($this->getFilterSessionKey());
                }
            }    
        }
    }

    public function clearStoredFilterValues(): void
    {
        if($this->shouldStoreFiltersInSession())
        {
            session([$this->getFilterSessionKey() => []]);
        }
    }
}
