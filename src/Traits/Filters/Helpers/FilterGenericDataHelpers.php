<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Filters\Helpers;

use Livewire\Attributes\Computed;

trait FilterGenericDataHelpers
{
    public function hasFilterGenericData(): bool
    {
        return ! empty($this->filterGenericData);
    }

    #[Computed]
    public function getFilterGenericData(): array
    {
        if (! $this->hasFilterGenericData()) {
            $this->setFilterGenericData($this->generateFilterGenericData());
        }

        return $this->filterGenericData;
    }
}
