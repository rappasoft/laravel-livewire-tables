<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Helpers;

trait QueryStringHelpers
{
    public function hasQueryStringStatus(): bool
    {
        return isset($this->queryStringStatus);
    }

    public function getQueryStringStatus(): bool
    {
        return $this->queryStringStatus ?? true;
    }

    public function queryStringIsEnabled(): bool
    {
        $this->setupQueryStringStatus();

        return $this->getQueryStringStatus() === true;
    }

    public function queryStringIsDisabled(): bool
    {
        return $this->getQueryStringStatus() === false;
    }

    public function hasQueryStringAlias(): bool
    {
        return isset($this->queryStringAlias);
    }

    public function getQueryStringAlias(): string
    {
        return $this->queryStringAlias ?? $this->getTableName();
    }

    protected function getQueryStringConfig(string $type): array
    {
        return array_merge(['status' => null, 'alias' => null], ($this->queryStringConfig[$type] ?? []));
    }

    protected function hasQueryStringConfigStatus(string $type): bool
    {
        return isset($this->getQueryStringConfig($type)['status']);
    }

    protected function getQueryStringConfigStatus(string $type): bool
    {
        return $this->getQueryStringConfig($type)['status'] ?? $this->getQueryStringStatus();
    }

    protected function hasQueryStringConfigAlias(string $type): bool
    {
        return isset($this->getQueryStringConfig($type)['alias']);
    }

    protected function getQueryStringConfigAlias(string $type): string
    {
        return $this->getQueryStringConfig($type)['alias'] ?? $this->getQueryStringAlias().'-'.$type;
    }
}
