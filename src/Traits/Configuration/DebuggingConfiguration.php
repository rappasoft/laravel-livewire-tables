<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Configuration;

trait DebuggingConfiguration
{
    /**
     * @param  bool  $status
     *
     * @return self
     */
    public function setDebugStatus(bool $status): self
    {
        $this->debugStatus = $status;

        return $this;
    }

    /**
     * @return self
     */
    public function setDebugEnabled(): self
    {
        $this->setDebugStatus(true);

        return $this;
    }

    /**
     * @return self
     */
    public function setDebugDisabled(): self
    {
        $this->setDebugStatus(false);

        return $this;
    }
}
