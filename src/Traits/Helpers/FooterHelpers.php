<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Helpers;

use Rappasoft\LaravelLivewireTables\Views\Column;

trait FooterHelpers
{
    /**
     * @return bool
     */
    public function hasColumnsWithFooter(): bool
    {
        return $this->columnsWithFooter === true;
    }

    /**
     * @return bool
     */
    public function getFooterStatus(): bool
    {
        return $this->footerStatus;
    }

    /**
     * @return bool
     */
    public function footerIsEnabled(): bool
    {
        return $this->getFooterStatus() === true;
    }

    /**
     * @return bool
     */
    public function footerIsDisabled(): bool
    {
        return $this->getFooterStatus() === false;
    }

    /**
     * @return bool
     */
    public function getUseHeaderAsFooterStatus(): bool
    {
        return $this->useHeaderAsFooterStatus;
    }

    /**
     * @return bool
     */
    public function useHeaderAsFooterIsEnabled(): bool
    {
        return $this->getUseHeaderAsFooterStatus() === true;
    }

    /**
     * @return bool
     */
    public function useHeaderAsFooterIsDisabled(): bool
    {
        return $this->getUseHeaderAsFooterStatus() === false;
    }

    /**
     * @param mixed $rows
     *
     * @return array<mixed>
     */
    public function getFooterTrAttributes($rows): array
    {
        return $this->footerTrAttributesCallback ? call_user_func($this->footerTrAttributesCallback, $rows) : ['default' => true];
    }

    /**
     * @param Column $column
     * @param mixed $rows
     * @param int $index
     *
     * @return array<mixed>
     */
    public function getFooterTdAttributes(Column $column, $rows, int $index): array
    {
        return $this->footerTdAttributesCallback ? call_user_func($this->footerTdAttributesCallback, $column, $rows, $index) : ['default' => true];
    }
}
