<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Helpers;

use Rappasoft\LaravelLivewireTables\Views\Column;

trait FooterHelpers
{
    public function hasColumnsWithFooter(): bool
    {
        return $this->columnsWithFooter === true;
    }

    public function getFooterStatus(): bool
    {
        return $this->footerStatus;
    }

    public function footerIsEnabled(): bool
    {
        return $this->getFooterStatus() === true;
    }

    public function footerIsDisabled(): bool
    {
        return $this->getFooterStatus() === false;
    }

    public function getUseHeaderAsFooterStatus(): bool
    {
        return $this->useHeaderAsFooterStatus;
    }

    public function useHeaderAsFooterIsEnabled(): bool
    {
        return $this->getUseHeaderAsFooterStatus() === true;
    }

    public function useHeaderAsFooterIsDisabled(): bool
    {
        return $this->getUseHeaderAsFooterStatus() === false;
    }

    public function getFooterTrAttributes(mixed $rows): array
    {
        return isset($this->footerTrAttributesCallback) ? call_user_func($this->footerTrAttributesCallback, $rows) : ['default' => true];
    }

    public function getFooterTdAttributes(Column $column, mixed $rows, int $index): array
    {
        return isset($this->footerTdAttributesCallback) ? call_user_func($this->footerTdAttributesCallback, $column, $rows, $index) : ['default' => true];
    }
}
