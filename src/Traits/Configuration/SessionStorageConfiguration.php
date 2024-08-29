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
}
