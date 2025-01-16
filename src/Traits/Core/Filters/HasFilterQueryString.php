<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Core\Filters;

use Livewire\Attributes\Locked;

trait HasFilterQueryString
{
    #[Locked]
    public ?bool $queryStringStatusForFilter;

    protected ?string $queryStringAliasForFilter;

    protected function queryStringHasQueryStringForFilter(): array
    {
        return ($this->queryStringForFilterIsEnabled()) ?
            [
                'appliedFilters' => ['except' => null, 'history' => false, 'keep' => false, 'as' => $this->getQueryStringAliasForFilter()],
                'filterComponents' => ['except' => null, 'history' => false, 'keep' => false, 'as' => $this->getQueryStringAliasForFilter()],
            ] : [];
    }

    protected function setupQueryStringStatusForFilter(): void
    {
        if (! $this->hasQueryStringStatusForFilter()) {
            $this->setQueryStringForFilterEnabled();
        }
    }

    public function hasQueryStringStatusForFilter(): bool
    {
        return isset($this->queryStringStatusForFilter);
    }

    public function getQueryStringStatusForFilter(): bool
    {
        return $this->queryStringStatusForFilter ?? true;
    }

    public function queryStringForFilterIsEnabled(): bool
    {
        $this->setupQueryStringStatusForFilter();

        return $this->getQueryStringStatusForFilter() && $this->filtersAreEnabled();
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

    public function setQueryStringAliasForFilter(string $alias): self
    {
        $this->queryStringAliasForFilter = $alias;

        return $this;
    }
}
