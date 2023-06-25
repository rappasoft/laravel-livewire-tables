<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Helpers;

use Rappasoft\LaravelLivewireTables\Views\Column;

trait ColumnSelectHelpers
{
    public function getColumnSelectStatus(): bool
    {
        return $this->columnSelectStatus;
    }

    public function columnSelectIsEnabled(): bool
    {
        return $this->getColumnSelectStatus() === true;
    }

    public function columnSelectIsDisabled(): bool
    {
        return $this->getColumnSelectStatus() === false;
    }

    public function getRememberColumnSelectionStatus(): bool
    {
        return $this->rememberColumnSelectionStatus;
    }

    public function rememberColumnSelectionIsEnabled(): bool
    {
        return $this->getRememberColumnSelectionStatus() === true;
    }

    public function rememberColumnSelectionIsDisabled(): bool
    {
        return $this->getRememberColumnSelectionStatus() === false;
    }

    /**
     * @param  mixed  $column
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

    public function setColumnSelectHiddenOnMobile(): self
    {
        $this->columnSelectHiddenOnMobile = true;

        return $this;
    }

    public function getColumnSelectIsHiddenOnTablet(): bool
    {
        return $this->columnSelectHiddenOnTablet;
    }

    public function setColumnSelectHiddenOnTablet(): self
    {
        $this->columnSelectHiddenOnTablet = true;

        return $this;
    }

    public function getColumnSelectIsHiddenOnMobile(): bool
    {
        return $this->columnSelectHiddenOnMobile;
    }
}
