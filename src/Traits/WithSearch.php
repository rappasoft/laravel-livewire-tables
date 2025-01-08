<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Computed;
use Rappasoft\LaravelLivewireTables\Events\SearchApplied;
use Rappasoft\LaravelLivewireTables\Traits\Core\QueryStrings\HasQueryStringForSearch;
use Rappasoft\LaravelLivewireTables\Traits\Core\Search\{HandlesSearchFieldStyling, HandlesSearchModifiers,HandlesSearchStatus, HandlesSearchTrim,HandlesSearchVisibility};

trait WithSearch
{
    use HandlesSearchStatus,
        HandlesSearchModifiers,
        HandlesSearchTrim,
        HandlesSearchVisibility,
        HasQueryStringForSearch,
        HandlesSearchFieldStyling;

    public string $search = '';

    // TODO
    public function applySearch(): Builder
    {
        if ($this->searchIsEnabled() && $this->hasSearch()) {

            $searchableColumns = $this->getSearchableColumns();
            $search = $this->getSearch();

            $this->callHook('searchUpdated', ['value' => $search]);
            $this->callTraitHook('searchUpdated', ['value' => $search]);
            if ($this->getEventStatusSearchApplied() && $search != null) {
                event(new SearchApplied($this->getTableName(), $search));
            }

            if ($searchableColumns->count()) {
                $this->setBuilder($this->getBuilder()->where(function ($query) use ($searchableColumns, $search) {
                    foreach ($searchableColumns as $index => $column) {
                        if ($column->hasSearchCallback()) {
                            ($column->getSearchCallback())($query, $search);
                        } else {
                            $query->{$index === 0 ? 'where' : 'orWhere'}($column->getColumn(), 'like', '%'.$search.'%');
                        }
                    }
                }));
            }
        }

        return $this->getBuilder();
    }

    public function updatedSearch(string|array|null $value): void
    {
        if ($this->shouldTrimSearchString() && $this->search != trim($value)) {
            $this->search = $value = trim($value);
        }

        $this->resetComputedPage();

        // Clear bulk actions on search - if enabled
        if ($this->getClearSelectedOnSearch()) {
            $this->clearSelected();
            $this->setSelectAllDisabled();
        }

        if (is_null($value) || $value === '') {
            $this->clearSearch();
        }
    }

    #[Computed]
    public function hasSearch(): bool
    {
        return $this->search != '';
    }

    #[Computed]
    public function getSearch(): string
    {
        if ($this->shouldTrimSearchString() && $this->search != trim($this->search)) {
            $this->search = trim($this->search);
        }

        return $this->search ?? '';
    }

    /**
     * Search the search query from the table array
     */
    public function clearSearch(): void
    {
        $this->search = '';
    }

    public function setSearch(string $query): self
    {
        if ($this->shouldTrimSearchString()) {
            $this->search = trim($query);
        } else {
            $this->search = $query;
        }

        return $this;
    }
}
