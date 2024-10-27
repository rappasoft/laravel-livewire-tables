<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Core\QueryStrings;

trait HasQueryStringForSearch
{
    protected function queryStringHasQueryStringForSearch(): array
    {
        return ($this->queryStringForSearchEnabled() && $this->searchIsEnabled()) ? ['search' => ['except' => null, 'history' => false, 'keep' => false, 'as' => $this->getQueryStringAliasForSearch()]] : [];

    }

    protected function setupQueryStringStatusForSearch(): void
    {
        if (! $this->hasQueryStringStatusForSearch()) {
            $this->setQueryStringForSearchEnabled();
        }
    }

    protected function hasQueryStringStatusForSearch(): bool
    {
        return $this->hasQueryStringConfigStatus('search');
    }

    protected function getQueryStringStatusForSearch(): bool
    {
        return $this->getQueryStringConfigStatus("search");
    }

    protected function queryStringForSearchEnabled(): bool
    {
        $this->setupQueryStringStatusForSearch();

        return $this->getQueryStringStatusForSearch() && $this->searchIsEnabled();
    }

    public function setQueryStringStatusForSearch(bool $status): self
    {
        return $this->setQueryStringConfigStatus("search", $status);
    }

    public function setQueryStringForSearchEnabled(): self
    {
        return $this->setQueryStringStatusForSearch(true);
    }

    public function setQueryStringForSearchDisabled(): self
    {
        return $this->setQueryStringStatusForSearch(false);
    }

    protected function hasQueryStringAliasForSearch(): bool
    {
        return $this->hasQueryStringConfigAlias('search');
    }

    protected function getQueryStringAliasForSearch(): string
    {
        return $this->getQueryStringConfigAlias("search");
    }

    public function setQueryStringAliasForSearch(string $alias): self
    {
        return $this->setQueryStringConfigAlias("search", $alias);
    }
}
