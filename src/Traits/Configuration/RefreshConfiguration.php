<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Configuration;

trait RefreshConfiguration
{
    public function setRefreshTime(int $time): self
    {
        $this->refresh = (string) $time;

        return $this;
    }

    public function setRefreshKeepAlive(): self
    {
        $this->refresh = 'keep-alive';

        return $this;
    }

    public function setRefreshVisible(): self
    {
        $this->refresh = 'visible';

        return $this;
    }

    public function setRefreshMethod(string $method): self
    {
        $this->refresh = $method;

        return $this;
    }
}
