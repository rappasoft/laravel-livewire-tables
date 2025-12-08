<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Helpers;

trait DeferredLoadingHelpers
{
    public function isDeferredLoading(): bool
    {
        return $this->deferLoading === true;
    }

    public function deferredLoadingIsEnabled(): bool
    {
        return $this->isDeferredLoading();
    }

    public function deferredLoadingIsDisabled(): bool
    {
        return ! $this->isDeferredLoading();
    }
}



