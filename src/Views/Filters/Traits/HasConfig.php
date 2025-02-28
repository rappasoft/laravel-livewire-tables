<?php

namespace Rappasoft\LaravelLivewireTables\Views\Filters\Traits;

trait HasConfig
{
    public function config(array $config = []): self
    {
        $this->config = [...config($this->configPath), ...$config];

        return $this;
    }

    public function getConfigs(): array
    {
        return ! empty($this->config) ? $this->config : $this->config = config($this->configPath);
    }
}
