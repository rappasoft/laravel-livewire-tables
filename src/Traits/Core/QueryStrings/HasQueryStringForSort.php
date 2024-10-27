<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Core\QueryStrings;

trait HasQueryStringForSort
{
    protected function queryStringHasQueryStringForSort(): array
    {
        return ($this->queryStringForSortEnabled() && $this->sortingIsEnabled()) ? ['sorts' => ['except' => null, 'history' => false, 'keep' => false, 'as' => $this->getQueryStringAliasForSort()]] : [];

    }

    protected function setupQueryStringStatusForSort(): void
    {
        if (! $this->hasQueryStringStatusForSort()) {
            $this->setQueryStringForSortEnabled();
        }
    }

    public function hasQueryStringStatusForSort(): bool
    {
        return $this->hasQueryStringConfigStatus('sorts');
    }

    public function getQueryStringStatusForSort(): bool
    {
        return $this->getQueryStringConfigStatus('sorts');
    }

    public function queryStringForSortEnabled(): bool
    {
        $this->setupQueryStringStatusForSort();

        return $this->getQueryStringStatusForSort() && $this->sortingIsEnabled();
    }

    public function setQueryStringStatusForSort(bool $status): self
    {
        return $this->setQueryStringConfigStatus('sorts', $status);
    }

    public function setQueryStringForSortEnabled(): self
    {
        return $this->setQueryStringStatusForSort(true);
    }

    public function setQueryStringForSortDisabled(): self
    {
        return $this->setQueryStringStatusForSort(false);
    }

    public function hasQueryStringAliasForSort(): bool
    {
        return $this->hasQueryStringConfigAlias('sorts');
    }

    public function getQueryStringAliasForSort(): string
    {
        return $this->getQueryStringConfigAlias('sorts');
    }

    public function setQueryStringAliasForSort(string $alias): self
    {
        return $this->setQueryStringConfigAlias('sorts', $alias);
    }
}
