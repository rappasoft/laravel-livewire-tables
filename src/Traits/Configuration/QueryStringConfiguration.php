<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Configuration;

trait QueryStringConfiguration
{
    public function setupQueryStringStatus(): void
    {
        if (! $this->hasQueryStringStatus()) {
            $this->runCoreConfiguration();
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

    public function setQueryStringAlias(string $queryStringAlias): self
    {
        $this->queryStringAlias = $queryStringAlias;

        return $this;
    }

    protected function setQueryStringConfig(string $type, array $config): self
    {
        $this->queryStringConfig[$type] = array_merge($this->getQueryStringConfig($type), $config);

        return $this;
    }

    protected function setQueryStringConfigStatus(string $type, bool $status): self
    {
        return $this->setQueryStringConfig($type, ['status' => $status]);

    }

    protected function setQueryStringConfigAlias(string $type, string $alias): self
    {
        return $this->setQueryStringConfig($type, ['alias' => $alias]);
    }
}
