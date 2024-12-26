<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Core\QueryStrings;

trait HasQueryStringForColumnSelect
{
    protected function queryStringHasQueryStringForColumnSelect(): array
    {
        return (($this->queryStringIsEnabled() || $this->queryStringForColumnSelectEnabled()) && $this->columnSelectIsEnabled()) ? ['selectedColumns' => ['except' => null, 'history' => false, 'keep' => false, 'as' => $this->getQueryStringAliasForColumnSelect()]] : [];

    }

    protected function setupQueryStringStatusForColumnSelect(): void
    {
        if (! $this->hasQueryStringStatusForColumnSelect()) {
            $this->setQueryStringForColumnSelectEnabled();
        }
    }

    public function hasQueryStringStatusForColumnSelect(): bool
    {
        return $this->hasQueryStringConfigStatus('columns');
    }

    public function getQueryStringStatusForColumnSelect(): bool
    {
        return $this->getQueryStringConfigStatus('columns');
    }

    public function queryStringForColumnSelectEnabled(): bool
    {
        $this->setupQueryStringStatusForColumnSelect();

        return $this->getQueryStringStatusForColumnSelect() && $this->columnSelectIsEnabled();
    }

    public function setQueryStringStatusForColumnSelect(bool $status): self
    {
        return $this->setQueryStringConfigStatus('columns', $status);
    }

    public function setQueryStringForColumnSelectEnabled(): self
    {
        return $this->setQueryStringStatusForColumnSelect(true);
    }

    public function setQueryStringForColumnSelectDisabled(): self
    {
        return $this->setQueryStringStatusForColumnSelect(false);
    }

    public function hasQueryStringAliasForColumnSelect(): bool
    {
        return $this->hasQueryStringConfigAlias('columns');
    }

    public function getQueryStringAliasForColumnSelect(): string
    {
        return $this->getQueryStringConfigAlias('columns');
    }

    public function setQueryStringAliasForColumnSelect(string $alias): self
    {
        return $this->setQueryStringConfigAlias('columns', $alias);
    }
}
