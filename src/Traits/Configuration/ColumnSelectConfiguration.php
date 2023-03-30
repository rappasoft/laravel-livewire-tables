<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Configuration;

trait ColumnSelectConfiguration
{
    /**
     * @param bool $status
     *
     * @return self
     */
    public function setColumnSelectStatus(bool $status): self
    {
        $this->columnSelectStatus = $status;

        return $this;
    }

    /**
     * @return self
     */
    public function setColumnSelectEnabled(): self
    {
        $this->setColumnSelectStatus(true);

        return $this;
    }

    /**
     * @return self
     */
    public function setColumnSelectDisabled(): self
    {
        $this->setColumnSelectStatus(false);

        return $this;
    }

    /**
     * @param bool $status
     *
     * @return self
     */
    public function setRememberColumnSelectionStatus(bool $status): self
    {
        $this->rememberColumnSelectionStatus = $status;

        return $this;
    }

    /**
     * @return self
     */
    public function setRememberColumnSelectionEnabled(): self
    {
        $this->setRememberColumnSelectionStatus(true);

        return $this;
    }

    /**
     * @return self
     */
    public function setRememberColumnSelectionDisabled(): self
    {
        $this->setRememberColumnSelectionStatus(false);

        return $this;
    }
}
