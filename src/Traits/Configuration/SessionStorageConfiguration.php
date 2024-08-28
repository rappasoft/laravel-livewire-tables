<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Configuration;

trait SessionStorageConfiguration
{

    protected function storeFiltersInSessionStatus(bool $status): self
    {
        $this->sessionStorageStatus['filters'] = $status;

        return $this;
    }

    protected function storeFiltersInSessionEnabled(): self
    {
        return $this->storeFiltersInSessionStatus(true);
    }
    
    protected function storeFiltersInSessionDisabled(): self
    {
        return $this->storeFiltersInSessionStatus(false);   
    }

}