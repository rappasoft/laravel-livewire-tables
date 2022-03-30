<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Configuration;

trait DebuggingConfiguration
{
    /**
     * @param  bool  $status
     *
     * @return $this
     */
    public function setDebugStatus(bool $status): self
    {
        $this->debugStatus = $status;

        return $this;
    }

    /**
     * @return $this
     */
    public function setDebugEnabled(): self
    {
        $this->setDebugStatus(true);

        return $this;
    }

    /**
     * @return $this
     */
    public function setDebugDisabled(): self
    {
        $this->setDebugStatus(false);

        return $this;
    }
}
