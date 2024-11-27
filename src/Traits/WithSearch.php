<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Locked;
use Rappasoft\LaravelLivewireTables\Events\SearchApplied;
use Rappasoft\LaravelLivewireTables\Traits\Configuration\SearchConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Core\QueryStrings\HasQueryStringForSearch;
use Rappasoft\LaravelLivewireTables\Traits\Helpers\SearchHelpers;
use Rappasoft\LaravelLivewireTables\Traits\Styling\HasSearchFieldStyling;

trait WithSearch
{
    use SearchConfiguration,
        SearchHelpers;
    use HasQueryStringForSearch;
    use HasSearchFieldStyling;

    public string $search = '';

    #[Locked]
    public bool $searchStatus = true;

    protected bool $searchVisibilityStatus = true;

    protected ?bool $searchFilterBlur = null;

    protected ?int $searchFilterDebounce = null;

    protected ?bool $searchFilterDefer = null;

    protected ?bool $searchFilterLazy = null;

    protected ?bool $searchFilterLive = null;

    protected ?int $searchFilterThrottle = null;

    protected bool $trimSearchString = false;

    // TODO
    public function applySearch(): Builder
    {
        if ($this->searchIsEnabled() && $this->hasSearch()) {

            $searchableColumns = $this->getSearchableColumns();
            $search = $this->getSearch();

            if ($this->shouldTrimSearchString()) {
                $search = trim($search);
            }

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
}
