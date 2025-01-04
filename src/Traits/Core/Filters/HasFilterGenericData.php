<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Core\Filters;

use Livewire\Attributes\Computed;
use Rappasoft\LaravelLivewireTables\DataTransferObjects\FilterGenericData;

trait HasFilterGenericData
{
    public array $filterGenericData = [];

    public function generateFilterGenericData(): array
    {
        return (new FilterGenericData($this->getTableName(), $this->getFilterLayout(), $this->isTailwind(), $this->isBootstrap4(), $this->isBootstrap5()))->toArray();
    }

    public function setFilterGenericData(array $filterGenericData = []): void
    {
        $this->filterGenericData = $filterGenericData;
    }

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
