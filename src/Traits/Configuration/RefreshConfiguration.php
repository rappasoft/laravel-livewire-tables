<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Configuration;

trait RefreshConfiguration
{
    /**
     * @param  int|string  $time
     *
     * @return self
     */
    public function setRefreshTime(int|string $time): self
    {
        $this->refresh = $time;

        return $this;
    }

    /**
     * @return self
     */
    public function setRefreshKeepAlive(): self
    {
        $this->refresh = 'keep-alive';

        return $this;
    }

    /**
     * @return self
     */
    public function setRefreshVisible(): self
    {
        $this->refresh = 'visible';

        return $this;
    }

    /**
     * @param  string  $method
     *
     * @return self
     */
    public function setRefreshMethod(string $method): self
    {
        $this->refresh = $method;

        return $this;
    }
}
