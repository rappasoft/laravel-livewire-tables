<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Configuration;

trait SecondaryHeaderConfiguration
{
    /**
     * @param bool $status
     *
     * @return self
     */
    public function setSecondaryHeaderStatus(bool $status): self
    {
        $this->secondaryHeaderStatus = $status;

        return $this;
    }

    /**
     * @return self
     */
    public function setSecondaryHeaderEnabled(): self
    {
        $this->setSecondaryHeaderStatus(true);

        return $this;
    }

    /**
     * @return self
     */
    public function setSecondaryHeaderDisabled(): self
    {
        $this->setSecondaryHeaderStatus(false);

        return $this;
    }

    /**
     * @param callable $callback
     *
     * @return self
     */
    public function setSecondaryHeaderTrAttributes(callable $callback): self
    {
        $this->secondaryHeaderTrAttributesCallback = $callback;

        return $this;
    }

    /**
     * @param callable $callback
     *
     * @return self
     */
    public function setSecondaryHeaderTdAttributes(callable $callback): self
    {
        $this->secondaryHeaderTdAttributesCallback = $callback;

        return $this;
    }
}
