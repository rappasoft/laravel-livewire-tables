<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Rappasoft\LaravelLivewireTables\Traits\Configuration\FooterConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Helpers\FooterHelpers;

trait WithFooter
{
    use FooterConfiguration,
        FooterHelpers;

    protected bool $footerStatus = true;

    protected bool $useHeaderAsFooterStatus = false;

    protected bool $columnsWithFooter = false;

    protected $footerTrAttributesCallback;

    protected $footerTdAttributesCallback;

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
