<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Helpers;

use Rappasoft\LaravelLivewireTables\Views\Column;

trait ColumnSelectHelpers
{
    /**
     * @return bool
     */
    public function getColumnSelectStatus(): bool
    {
        return $this->columnSelectStatus;
    }

    /**
     * @return bool
     */
    public function columnSelectIsEnabled(): bool
    {
        return $this->getColumnSelectStatus() === true;
    }

    /**
     * @return bool
     */
    public function columnSelectIsDisabled(): bool
    {
        return $this->getColumnSelectStatus() === false;
    }

    /**
     * @return bool
     */
    public function getRememberColumnSelectionStatus(): bool
    {
        return $this->rememberColumnSelectionStatus;
    }

    /**
     * @return bool
     */
    public function rememberColumnSelectionIsEnabled(): bool
    {
        return $this->getRememberColumnSelectionStatus() === true;
    }

    /**
     * @return bool
     */
    public function rememberColumnSelectionIsDisabled(): bool
    {
        return $this->getRememberColumnSelectionStatus() === false;
    }

    /**
     * @param mixed $column
     *
     * @return bool
     */
    public function columnSelectIsEnabledForColumn($column): bool
    {
        return in_array($column instanceof Column ? $column->getSlug() : $column, $this->selectedColumns, true);
    }

    /**
     * @return void
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
     * @return self
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
     * @return self
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
