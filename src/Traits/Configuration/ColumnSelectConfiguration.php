<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Configuration;

trait ColumnSelectConfiguration
{
    /**
     * @var bool
     */
    public function setColumnSelectStatus(bool $status): self
    {
        $this->columnSelectStatus = $status;

        return $this;
    }

    /**
     * @var bool
     */
    public function setColumnSelectEnabled(): self
    {
        $this->setColumnSelectStatus(true);

        return $this;
    }

    /**
     * @var bool
     */
    public function setColumnSelectDisabled(): self
    {
        $this->setColumnSelectStatus(false);

        return $this;
    }

    /**
     * @var bool
     */
    public function setRememberColumnSelectionStatus(bool $status): self
    {
        $this->rememberColumnSelectionStatus = $status;

        return $this;
    }

    /**
     * @var bool
     */
    public function setRememberColumnSelectionEnabled(): self
    {
        $this->setRememberColumnSelectionStatus(true);

        return $this;
    }

    /**
     * @var bool
     */
    public function setRememberColumnSelectionDisabled(): self
    {
        $this->setRememberColumnSelectionStatus(false);

        return $this;
    }
}
