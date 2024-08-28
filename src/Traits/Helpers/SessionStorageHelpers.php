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
        return $this->sessionStorageStatus['filters'] ?? false;
    }

    protected function shouldStoreFiltersInSession(): bool
    {
        return $this->getSessionStorageStatus('filters');
    }

    public function getFilterSessionKey(): string
    {
        return $this->getTableName().'-filter-backup';
    }

    public function storeFiltersInSession(): void
    {
        if (session()->has($this->getFilterSessionKey())) {
            session()->forget($this->getFilterSessionKey());
        }
        session([$this->getFilterSessionKey() => $this->appliedFilters]);

    }

    public function restoreFiltersFromSession(): void
    {
        if (session()->has($this->getFilterSessionKey())) {
            $this->appliedFilters = session()->get($this->getFilterSessionKey());
        }
    }
}
