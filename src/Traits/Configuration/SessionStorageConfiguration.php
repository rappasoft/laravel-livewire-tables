<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Configuration;

trait SessionStorageConfiguration
{
    protected function storeFiltersInSessionStatus(bool $status): self
    {
        $this->sessionStorageStatus['filters'] = $status;

        return $this;
    }

    public function storeFiltersInSessionEnabled(): self
    {
        return $this->storeFiltersInSessionStatus(true);
    }

    public function storeFiltersInSessionDisabled(): self
    {
        return $this->storeFiltersInSessionStatus(false);
    }

    protected function storeColumnSelectInSessionStatus(bool $status): self
    {
        $this->sessionStorageStatus['columnselect'] = $status;

        return $this;
    }

    public function storeColumnSelectInSessionEnabled(): self
    {
        return $this->storeColumnSelectInSessionStatus(true);
    }

    public function storeColumnSelectInSessionDisabled(): self
    {
        return $this->storeColumnSelectInSessionStatus(false);
    }
}
