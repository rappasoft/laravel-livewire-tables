<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Core\QueryStrings;

use Livewire\Attributes\Locked;

trait HasQueryStringForSearch
{
    #[Locked]
    public ?bool $queryStringStatusForSearch;

    protected ?string $queryStringAliasForSearch;

    protected function queryStringHasQueryStringForSearch(): array
    {
        return ($this->queryStringForSearchEnabled() && $this->searchIsEnabled()) ? ['search' => ['except' => null, 'history' => false, 'keep' => false, 'as' => $this->getQueryStringAliasForSearch()]] : [];

    }

    public function setupQueryStringStatusForSearch(): void
    {
        if (! $this->hasQueryStringStatusForSearch()) {
            $this->setQueryStringForSearchEnabled();
        }
    }

    public function hasQueryStringStatusForSearch(): bool
    {
        return isset($this->queryStringStatusForSearch);
    }

    public function getQueryStringStatusForSearch(): bool
    {
        return $this->queryStringStatusForSearch ?? true;
    }

    public function queryStringForSearchEnabled(): bool
    {
        $this->setupQueryStringStatusForSearch();

        return $this->getQueryStringStatusForSearch() && $this->searchIsEnabled();
    }

    public function setQueryStringStatusForSearch(bool $status): self
    {
        $this->queryStringStatusForSearch = $status;

        return $this;
    }

    public function setQueryStringForSearchEnabled(): self
    {
        $this->setQueryStringStatusForSearch(true);

        return $this;
    }

    public function setQueryStringForSearchDisabled(): self
    {
        $this->setQueryStringStatusForSearch(false);

        return $this;
    }

    public function hasQueryStringAliasForSearch(): bool
    {
        return isset($this->queryStringAliasForSearch);
    }

    public function getQueryStringAliasForSearch(): string
    {
        return $this->queryStringAliasForSearch ?? $this->getQueryStringAlias().'-search';
    }

    public function setQueryStringAliasForSearch(string $alias): self
    {
        $this->queryStringAliasForSearch = $alias;

        return $this;
    }
}
