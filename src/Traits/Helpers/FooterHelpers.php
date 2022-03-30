<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Helpers;

use Rappasoft\LaravelLivewireTables\Views\Column;

trait FooterHelpers
{
    /**
     * @var bool
     */
    public function hasColumnsWithFooter(): bool
    {
        return $this->columnsWithFooter === true;
    }

    /**
     * @var bool
     */
    public function getFooterStatus(): bool
    {
        return $this->footerStatus;
    }

    /**
     * @var bool
     */
    public function footerIsEnabled(): bool
    {
        return $this->getFooterStatus() === true;
    }

    /**
     * @var bool
     */
    public function footerIsDisabled(): bool
    {
        return $this->getFooterStatus() === false;
    }

    /**
     * @var bool
     */
    public function getUseHeaderAsFooterStatus(): bool
    {
        return $this->useHeaderAsFooterStatus;
    }

    /**
     * @var bool
     */
    public function useHeaderAsFooterIsEnabled(): bool
    {
        return $this->getUseHeaderAsFooterStatus() === true;
    }

    /**
     * @var bool
     */
    public function useHeaderAsFooterIsDisabled(): bool
    {
        return $this->getUseHeaderAsFooterStatus() === false;
    }

    /**
     * @var callable
     */
    public function getFooterTrAttributes($rows): array
    {
        return $this->footerTrAttributesCallback ? call_user_func($this->footerTrAttributesCallback, $rows) : ['default' => true];
    }

    /**
     * @var callable
     */
    public function getFooterTdAttributes(Column $column, $rows, int $index): array
    {
        return $this->footerTdAttributesCallback ? call_user_func($this->footerTdAttributesCallback, $column, $rows, $index) : ['default' => true];
    }
}
