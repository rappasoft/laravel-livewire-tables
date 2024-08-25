<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Configuration;

trait SecondaryHeaderConfiguration
{
    public function setSecondaryHeaderStatus(bool $status): self
    {
        $this->secondaryHeaderStatus = $status;

        return $this;
    }

    public function setSecondaryHeaderEnabled(): self
    {
        $this->setSecondaryHeaderStatus(true);

        return $this;
    }

    public function setSecondaryHeaderDisabled(): self
    {
        $this->setSecondaryHeaderStatus(false);

        return $this;
    }

    public function setSecondaryHeaderTrAttributes(\Closure $callback): self
    {
        $this->secondaryHeaderTrAttributesCallback = $callback;

        return $this;
    }

    public function setSecondaryHeaderTdAttributes(\Closure $callback): self
    {
        $this->secondaryHeaderTdAttributesCallback = $callback;

        return $this;
    }
}
