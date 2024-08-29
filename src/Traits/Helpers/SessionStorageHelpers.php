<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Helpers;

trait SessionStorageHelpers
{
    protected function getSessionStorageStatus(string $name): bool
    {
        return $this->sessionStorageStatus[$name] ?? false;
    }

    public function shouldStoreFiltersInSession(): bool
    {
        return $this->getSessionStorageStatus('filters');
    }

    public function getFilterSessionKey(): string
    {
        return $this->getTableName().'-stored-filters';
    }

    public function storeFilterValues(): void
    {
        if ($this->shouldStoreFiltersInSession()) {
            $this->clearStoredFilterValues();
            session([$this->getFilterSessionKey() => $this->appliedFilters]);
        }
    }

    public function restoreFilterValues(): void
    {
        if (empty($this->filterComponents) || empty($this->appliedFilters)) {
            $this->filterComponents = $this->appliedFilters = $this->getStoredFilterValues();
        }
    }

    public function getStoredFilterValues(): array
    {
        if ($this->shouldStoreFiltersInSession() && session()->has($this->getFilterSessionKey())) {
            return session()->get($this->getFilterSessionKey());
        }

        return [];
    }

    public function clearStoredFilterValues(): void
    {
        if ($this->shouldStoreFiltersInSession() && session()->has($this->getFilterSessionKey())) {
            session()->forget($this->getFilterSessionKey());
        }
    }
}
