<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Filters;

use Livewire\Attributes\Locked;

trait HasFilterQueryString
{
    protected function queryStringHasFilterQueryString(): array
    {
        return ($this->queryStringForFilterIsEnabled()) ?
            [
                'appliedFilters' => ['except' => null, 'history' => false, 'keep' => false, 'as' => $this->getQueryStringAliasForFilter()],
                'filterComponents' => ['except' => null, 'history' => false, 'keep' => false, 'as' => $this->getQueryStringAliasForFilter()],
            ] : [];
    }

    public function queryStringForFilterIsEnabled(): bool
    {
        return $this->getQueryStringStatusForFilter() && $this->filtersAreEnabled();
    }

    public function hasQueryStringStatusForFilter(): bool
    {
        return $this->hasQueryStringConfigStatus('filters');
    }

    public function getQueryStringStatusForFilter(): bool
    {
        return $this->getQueryStringConfigStatus('filters');
    }

    public function hasQueryStringAliasForFilter(): bool
    {
        return $this->hasQueryStringConfigAlias('filters');
    }

    public function getQueryStringAliasForFilter(): string
    {
        return $this->getQueryStringConfigAlias('filters');
    }

    protected function setQueryStringStatusForFilter(bool $status): self
    {
        return $this->setQueryStringConfigStatus('filters', $status);
    }

    protected function setQueryStringForFilterEnabled(): self
    {
        return $this->setQueryStringStatusForFilter(true);
    }

    protected function setQueryStringForFilterDisabled(): self
    {
        return $this->setQueryStringStatusForFilter(false);
    }

    protected function setQueryStringAliasForFilter(string $alias): self
    {
        return $this->setQueryStringConfigAlias('filters', $alias);
    }
}
