<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Rappasoft\LaravelLivewireTables\Traits\Configuration\SecondaryHeaderConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Helpers\SecondaryHeaderHelpers;

trait WithSecondaryHeader
{
    use SecondaryHeaderConfiguration,
        SecondaryHeaderHelpers;

    protected bool $secondaryHeaderStatus = true;

    protected bool $columnsWithSecondaryHeader = false;

    protected ?\Closure $secondaryHeaderTrAttributesCallback;

    protected ?\Closure $secondaryHeaderTdAttributesCallback;

    public function bootedWithSecondaryHeader(): void
    {
        $this->setupSecondaryHeader();
    }

    public function setupSecondaryHeader(): void
    {
        foreach ($this->getColumns() as $column) {
            if ($column->hasSecondaryHeader()) {
                $this->columnsWithSecondaryHeader = true;
            }
        }
    }
}
