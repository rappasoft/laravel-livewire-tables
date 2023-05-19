<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Configuration;

trait DebuggingConfiguration
{
    public function setDebugStatus(bool $status): self
    {
        $this->debugStatus = $status;

        return $this;
    }

    public function setDebugEnabled(): self
    {
        $this->setDebugStatus(true);

        return $this;
    }

    public function setDebugDisabled(): self
    {
        $this->setDebugStatus(false);

        return $this;
    }
}
