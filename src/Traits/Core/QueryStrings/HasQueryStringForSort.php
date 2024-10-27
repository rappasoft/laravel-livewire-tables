<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Core\QueryStrings;

use Livewire\Attributes\Locked;

trait HasQueryStringForSort
{
    #[Locked]
    public ?bool $queryStringStatusForSort;

    protected ?string $queryStringAliasForSort;

    protected function queryStringHasQueryStringForSort(): array
    {
        return ($this->queryStringForSortEnabled() && $this->sortingIsEnabled()) ? ['sorts' => ['except' => null, 'history' => false, 'keep' => false, 'as' => $this->getQueryStringAliasForSort()]] : [];

    }

    public function setupQueryStringStatusForSort(): void
    {
        if (! $this->hasQueryStringStatusForSort()) {
            $this->setQueryStringForSortEnabled();
        }
    }

    public function hasQueryStringStatusForSort(): bool
    {
        return isset($this->queryStringStatusForSort);
    }

    public function getQueryStringStatusForSort(): bool
    {
        return $this->queryStringStatusForSort ?? true;
    }

    public function queryStringForSortEnabled(): bool
    {
        $this->setupQueryStringStatusForSort();

        return $this->getQueryStringStatusForSort() && $this->sortingIsEnabled();
    }

    public function setQueryStringStatusForSort(bool $status): self
    {
        $this->queryStringStatusForSort = $status;

        return $this;
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
        return isset($this->queryStringAliasForSort);
    }

    public function getQueryStringAliasForSort(): string
    {
        return $this->queryStringAliasForSort ?? $this->getQueryStringAlias().'-sorts';
    }

    public function setQueryStringAliasForSort(string $alias): self
    {
        $this->queryStringAliasForSort = $alias;

        return $this;
    }
}
