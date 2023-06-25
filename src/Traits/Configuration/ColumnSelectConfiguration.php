<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Configuration;

trait ColumnSelectConfiguration
{
    public function setColumnSelectStatus(bool $status): self
    {
        $this->columnSelectStatus = $status;

        return $this;
    }

    public function setColumnSelectEnabled(): self
    {
        $this->setColumnSelectStatus(true);

        return $this;
    }

    public function setColumnSelectDisabled(): self
    {
        $this->setColumnSelectStatus(false);

        return $this;
    }

    public function setRememberColumnSelectionStatus(bool $status): self
    {
        $this->rememberColumnSelectionStatus = $status;

        return $this;
    }

    public function setRememberColumnSelectionEnabled(): self
    {
        $this->setRememberColumnSelectionStatus(true);

        return $this;
    }

    public function setRememberColumnSelectionDisabled(): self
    {
        $this->setRememberColumnSelectionStatus(false);

        return $this;
    }
}
