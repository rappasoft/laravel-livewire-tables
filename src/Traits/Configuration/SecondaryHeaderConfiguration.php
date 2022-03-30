<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Configuration;

trait SecondaryHeaderConfiguration
{
    /**
     * @var bool
     */
    public function setSecondaryHeaderStatus(bool $status): self
    {
        $this->secondaryHeaderStatus = $status;

        return $this;
    }

    /**
     * @var bool
     */
    public function setSecondaryHeaderEnabled(): self
    {
        $this->setSecondaryHeaderStatus(true);

        return $this;
    }

    /**
     * @var bool
     */
    public function setSecondaryHeaderDisabled(): self
    {
        $this->setSecondaryHeaderStatus(false);

        return $this;
    }

    /**
     * @var bool
     */
    public function setSecondaryHeaderTrAttributes(callable $callback): self
    {
        $this->secondaryHeaderTrAttributesCallback = $callback;

        return $this;
    }

    /**
     * @var bool
     */
    public function setSecondaryHeaderTdAttributes(callable $callback): self
    {
        $this->secondaryHeaderTdAttributesCallback = $callback;

        return $this;
    }
}
