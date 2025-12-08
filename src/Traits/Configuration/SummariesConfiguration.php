<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Configuration;

trait SummariesConfiguration
{
    public function setSummariesEnabled(): self
    {
        $this->summariesStatus = true;

        return $this;
    }

    public function setSummariesDisabled(): self
    {
        $this->summariesStatus = false;

        return $this;
    }

    public function setSummariesStatus(bool $status): self
    {
        $this->summariesStatus = $status;

        return $this;
    }
}



