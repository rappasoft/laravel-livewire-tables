<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Configuration;

trait LoadingConfiguration
{
    /**
     * @param  bool  $status
     *
     * @return $this
     */
    public function setLoadingStatus(bool $status): self
    {
        $this->loading = $status;

        return $this;
    }

    /**
     * @return $this
     */
    public function setLoadingEnabled(): self
    {
        $this->loading = true;

        return $this;
    }

    /**
     * @return $this
     */
    public function setLoadingDisabled(): self
    {
        $this->loading = false;

        return $this;
    }

    /**
     * @param  bool  $status
     *
     * @return $this
     */
    public function setLoadingDelayStatus(bool $status): self
    {
        $this->loadingDelay = $status;

        return $this;
    }

    /**
     * @return $this
     */
    public function setLoadingDelayEnabled(): self
    {
        $this->loadingDelay = true;

        return $this;
    }

    /**
     * @return $this
     */
    public function setLoadingDelayDisabled(): self
    {
        $this->loadingDelay = false;

        return $this;
    }

    /**
     * @param  string  $modifier
     *
     * @return $this
     */
    public function setLoadingDelayModifier(string $modifier): self
    {
        $this->loadingDelayModifier = $modifier;

        return $this;
    }
}
