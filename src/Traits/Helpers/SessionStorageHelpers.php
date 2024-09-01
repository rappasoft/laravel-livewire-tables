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

    public function shouldStoreColumnSelectInSession(): bool
    {
        return $this->getSessionStorageStatus('columnselect');
    }

    public function getColumnSelectSessionKey(): string
    {
        return $this->getTableName().'-stored-columnselect';
    }

    public function storeColumnSelectValues(): void
    {
        if ($this->shouldStoreColumnSelectInSession()) {
            $this->clearStoredColumnSelectValues();
            session([$this->getColumnSelectSessionKey() => $this->selectedColumns]);
        }
    }

    public function restoreColumnSelectValues(): void
    {
        $this->selectedColumns = $this->getStoredColumnSelectValues();
    }

    public function getStoredColumnSelectValues(): array
    {
        if ($this->shouldStoreColumnSelectInSession() && session()->has($this->getColumnSelectSessionKey())) {
            return session()->get($this->getColumnSelectSessionKey());
        }

        return [];
    }

    public function clearStoredColumnSelectValues(): void
    {
        if ($this->shouldStoreColumnSelectInSession() && session()->has($this->getColumnSelectSessionKey())) {
            session()->forget($this->getColumnSelectSessionKey());
        }
    }

    protected function forgetColumnSelectSession(): void
    {
        session()->forget($this->getColumnSelectSessionKey());
    }
}
