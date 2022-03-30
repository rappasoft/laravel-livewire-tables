<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Configuration;

trait RefreshConfiguration
{
    /**
     * @param  int  $time
     *
     * @return $this
     */
    public function setRefreshTime(int $time): self
    {
        $this->refresh = $time;

        return $this;
    }

    /**
     * @return $this
     */
    public function setRefreshKeepAlive(): self
    {
        $this->refresh = 'keep-alive';

        return $this;
    }

    /**
     * @return $this
     */
    public function setRefreshVisible(): self
    {
        $this->refresh = 'visible';

        return $this;
    }

    /**
     * @param  string  $method
     *
     * @return $this
     */
    public function setRefreshMethod(string $method): self
    {
        $this->refresh = $method;

        return $this;
    }
}
