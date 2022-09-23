<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Traits\Configuration\SearchConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Helpers\SearchHelpers;

trait WithSearch
{
    use SearchConfiguration,
        SearchHelpers;

    public ?string $search = null;
    public bool $searchStatus = true;
    public bool $searchVisibilityStatus = true;
    public ?int $searchFilterDebounce = null;
    public ?bool $searchFilterDefer = null;
    public ?bool $searchFilterLazy = null;

    // TODO
    public function applySearch(): Builder
    {
        if ($this->searchIsEnabled() && $this->hasSearch()) {
            $searchableColumns = $this->getSearchableColumns();

            if ($searchableColumns->count()) {
                $this->setBuilder($this->getBuilder()->where(function ($query) use ($searchableColumns) {
                    $searchTerms = preg_split("/[\s]+/", $this->getSearch(), -1, PREG_SPLIT_NO_EMPTY);

                    foreach ($searchTerms as $value) {
                        $query->where(function ($query) use ($searchableColumns, $value) {
                            foreach ($searchableColumns as $index => $column) {
                                if ($column->hasSearchCallback()) {
                                    ($column->getSearchCallback())($query, $this->getSearch());
                                } else {
                                    $query->{$index === 0 ? 'where' : 'orWhere'}($column->getColumn(), 'like', '%' . $value . '%');
                                }
                            }
                        });
                    }
                }));
            }
        }

        return $this->getBuilder();
    }
    }
