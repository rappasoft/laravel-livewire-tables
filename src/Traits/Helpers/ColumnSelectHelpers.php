<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Helpers;

use Rappasoft\LaravelLivewireTables\Views\Column;

trait ColumnSelectHelpers
{
    /**
     * @var bool
     */
    public function getColumnSelectStatus(): bool
    {
        return $this->columnSelectStatus;
    }

    /**
     * @param bool $status
     * @return $this
     */
    public function columnSelectIsEnabled(): bool
    {
        return $this->getColumnSelectStatus() === true;
    }

    /**
     * @param bool $status
     * @return $this
     */
    public function columnSelectIsDisabled(): bool
    {
        return $this->getColumnSelectStatus() === false;
    }

    /**
     * @param bool $status
     * @return $this
     */
    public function getRememberColumnSelectionStatus(): bool
    {
        return $this->rememberColumnSelectionStatus;
    }

    /**
     * @param bool $status
     * @return $this
     */
    public function rememberColumnSelectionIsEnabled(): bool
    {
        return $this->getRememberColumnSelectionStatus() === true;
    }

    /**
     * @param bool $status
     * @return $this
     */
    public function rememberColumnSelectionIsDisabled(): bool
    {
        return $this->getRememberColumnSelectionStatus() === false;
    }

    /**
     * @param bool $status
     * @return $this
     */
    public function columnSelectIsEnabledForColumn($column): bool
    {
        return in_array($column instanceof Column ? $column->getSlug() : $column, $this->selectedColumns, true);
    }

    /**
     * @param array $columns
     * @return $this
     */
    protected function forgetColumnSelectSession()
    {
        session()->forget($this->getColumnSelectSessionKey());
    }

    /**
     * @return string
     */
    protected function getColumnSelectSessionKey()
    {
        return $this->getDataTableFingerprint().'-columnSelectEnabled';
    }

    /**
     * @return $this
     */
    public function setColumnSelectHiddenOnMobile(): self
    {
        $this->columnSelectHiddenOnMobile = true;

        return $this;
    }

    /**
     * @return bool
     */
    public function getColumnSelectIsHiddenOnTablet(): bool
    {
        return $this->columnSelectHiddenOnTablet;
    }

     /**
     * @return $this
     */
    public function setColumnSelectHiddenOnTablet(): self
    {
        $this->columnSelectHiddenOnTablet = true;

        return $this;
    }

    /**
     * @return bool
     */
    public function getColumnSelectIsHiddenOnMobile(): bool
    {
        return $this->columnSelectHiddenOnMobile;
    }
}
