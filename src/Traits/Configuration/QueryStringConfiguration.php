<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Configuration;

trait QueryStringConfiguration
{
    public function setQueryStringAlias(string $queryStringAlias): self
    {
        $this->queryStringAlias = $queryStringAlias;

        return $this;
    }

    public function setupQueryStringStatus(): void
    {
        if (! $this->hasQueryStringStatus()) {
            $this->configure();
            if (! $this->hasQueryStringStatus()) {
                $this->setQueryStringEnabled();
            }
        }
    }

    public function setQueryStringStatus(bool $status): self
    {
        $this->queryStringStatus = $status;

        return $this;
    }

    public function setQueryStringEnabled(): self
    {
        $this->setQueryStringStatus(true);

        return $this;
    }

    public function setQueryStringDisabled(): self
    {
        $this->setQueryStringStatus(false);

        return $this;
    }
}
