<?php

declare(strict_types=1);

namespace Rappasoft\LaravelLivewireTables\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Livewire\Attributes\Locked;
use Rappasoft\LaravelLivewireTables\Traits\Configuration\SortingConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Helpers\SortingHelpers;

/**
 * Sorting functionality for DataTableComponent
 */
trait WithSorting
{
    use SortingConfiguration,
        SortingHelpers;

    /**
     * Active sorts (column => direction)
     * @var array<string, string>
     */
    public array $sorts = [];

    /**
     * Columns that are sortable
     */
    public Collection $sortableColumns;

    /**
     * Whether sorting is enabled
     */
    public bool $sortingStatus = true;

    /**
     * Whether only single column sorting is allowed
     */
    public bool $singleColumnSortingStatus = true;

    /**
     * Whether to show sorting pills
     */
    public bool $sortingPillsStatus = true;

    /**
     * Default sort column
     */
    public ?string $defaultSortColumn = null;

    /**
     * Default sort direction
     */
    public string $defaultSortDirection = 'asc';

    /**
     * Label for ascending sort
     */
    public string $defaultSortingLabelAsc = 'A-Z';

    /**
     * Label for descending sort
     */
    public string $defaultSortingLabelDesc = 'Z-A';

    public function queryStringWithSorting(): array
    {
        if ($this->queryStringIsEnabled() && $this->sortingIsEnabled()) {
            return [
                'sorts' => ['except' => null, 'history' => false, 'keep' => false, 'as' => $this->getQueryStringAlias().'-sorts'],
            ];
        }

        return [];
    }

    public function sortBy(string $columnSelectName): ?string
    {

        if ($this->sortingIsDisabled()) {
            return null;
        }

        // If single sorting is enabled and there are sorts but not the field that is being sorted,
        // then clear all the sorts
        if ($this->singleSortingIsEnabled() && $this->hasSorts() && ! $this->hasSort($columnSelectName)) {
            $this->clearSorts();
            $this->resetComputedPage();

        }

        if (! $this->hasSort($columnSelectName)) {
            $this->resetComputedPage();

            return $this->setSortAsc($columnSelectName);
        }

        if ($this->isSortAsc($columnSelectName)) {
            $this->resetComputedPage();

            return $this->setSortDesc($columnSelectName);
        }

        $this->clearSort($columnSelectName);

        return null;
    }

    public function applySorting(): Builder
    {
        if ($this->hasDefaultSort() && ! $this->hasSorts()) {
            $this->setBuilder($this->getBuilder()->orderBy($this->getDefaultSortColumn(), $this->getDefaultSortDirection()));

            return $this->getBuilder();
        }
        $allCols = $this->getColumns();

        foreach ($this->getSorts() as $column => $direction) {
            if (! in_array($direction, ['asc', 'desc'])) {
                $direction = 'asc';
            }
            $tmpCol = $column;
            $column = $this->getColumnBySelectName($tmpCol);

            if (is_null($column)) {
                foreach ($allCols as $cols) {
                    if ($cols->getSlug() == $tmpCol && $cols->hasSortCallback()) {
                        $this->setBuilder(call_user_func($cols->getSortCallback(), $this->getBuilder(), $direction));

                        continue;
                    }
                }

                continue;
            }

            if (! $column->isSortable()) {
                continue;
            }

            // TODO: Test
            if ($column->hasSortCallback()) {
                $this->setBuilder(call_user_func($column->getSortCallback(), $this->getBuilder(), $direction));
            } elseif ($column->isBaseColumn()) {
                $this->setBuilder($this->getBuilder()->orderBy($column->getColumnSelectName(), $direction));
            } else {
                $value = $this->getBuilder()->getGrammar()->wrap($column->getColumn().' as '.$column->getColumnSelectName());
                $segments = preg_split('/\s+as\s+/i', $value);
                $this->setBuilder($this->getBuilder()->orderByRaw($segments[1].' '.$direction));
            }
        }

        return $this->getBuilder();
    }
}
