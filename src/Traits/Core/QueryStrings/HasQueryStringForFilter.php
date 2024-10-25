<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Core\QueryStrings;

use Livewire\Attributes\Locked;

trait HasQueryStringForFilter
{
    #[Locked]
    public ?bool $queryStringStatusForFilter;

    protected ?string $queryStringAliasForFilter;

    public function hasQueryStringStatusForFilter(): bool
    {
        return isset($this->queryStringStatusForFilter);
    }

    public function setupQueryStringStatusForFilter(): void
    {
        if (! $this->hasQueryStringStatusForFilter()) {
            $this->setQueryStringForFilterEnabled();
        }
    }

    public function getQueryStringStatusForFilter(): bool
    {
        return $this->queryStringStatusForFilter ?? true;
    }

    public function queryStringForFilterIsEnabled(): bool
    {
        $this->setupQueryStringStatusForFilter();

        return $this->queryStringIsEnabled() === true && $this->getQueryStringStatusForFilter() === true && $this->filtersAreEnabled();
    }

    public function setQueryStringStatusForFilter(bool $status): self
    {
        $this->queryStringStatusForFilter = $status;

        return $this;
    }

    public function setQueryStringForFilterEnabled(): self
    {
        $this->setQueryStringStatusForFilter(true);

        return $this;
    }

    public function setQueryStringForFilterDisabled(): self
    {
        $this->setQueryStringStatusForFilter(false);

        return $this;
    }

    public function hasQueryStringAliasForFilter(): bool
    {
        return isset($this->queryStringAliasForFilter);
    }

    public function getQueryStringAliasForFilter(): string
    {
        return $this->queryStringAliasForFilter ?? $this->getQueryStringAlias().'-filters';
    }

    public function setQueryStringAliasForFilter(string $queryStringAliasForFilter): self
    {
        $this->queryStringAliasForFilter = $queryStringAliasForFilter;

        return $this;
    }
}
