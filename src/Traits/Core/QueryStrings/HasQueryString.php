<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Core\QueryStrings;

use Livewire\Attributes\Locked;

trait HasQueryString
{
    #[Locked]
    public array $queryStringConfig = [
        'columns' => [],
        'filter' => [],
        'search' => [],
        'sorts' => [],
    ];

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
