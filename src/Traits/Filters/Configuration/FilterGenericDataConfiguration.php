<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Filters\Configuration;

use Rappasoft\LaravelLivewireTables\DataTransferObjects\FilterGenericData;

trait FilterGenericDataConfiguration
{
    public function generateFilterGenericData(): array
    {
        return (new FilterGenericData($this->getTableName(), $this->getFilterLayout(), $this->isTailwind(), $this->isBootstrap4(), $this->isBootstrap5()))->toArray();
    }

    public function setFilterGenericData(array $filterGenericData = []): void
    {
        $this->filterGenericData = $filterGenericData;
    }
}
