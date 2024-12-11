<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Closure;
use Rappasoft\LaravelLivewireTables\Traits\Configuration\FooterConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Helpers\FooterHelpers;
use Rappasoft\LaravelLivewireTables\Traits\Styling\HasFooterStyling;

trait WithFooter
{
    use FooterConfiguration,
        FooterHelpers,
        HasFooterStyling;

    protected bool $footerStatus = true;

    protected bool $useHeaderAsFooterStatus = false;

    protected bool $columnsWithFooter = false;

    public function setupFooter(): void
    {
        foreach ($this->getColumns() as $column) {
            if ($column->hasFooter()) {
                $this->columnsWithFooter = true;
            }
        }
    }

    public function renderingWithFooter(): void
    {
        $this->setupFooter();
    }
}
