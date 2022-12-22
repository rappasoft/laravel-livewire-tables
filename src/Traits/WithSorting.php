<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Traits\Configuration\SortingConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Helpers\SortingHelpers;

trait WithSorting
{
    use SortingConfiguration,
        SortingHelpers;

    public array $sorts = [];
    public bool $sortingStatus = true;
    public bool $singleColumnSortingStatus = true;
    public bool $sortingPillsStatus = true;
    public ?string $defaultSortColumn = null;
    public string $defaultSortDirection = 'asc';
    public string $defaultSortingLabelAsc = 'A-Z';
    public string $defaultSortingLabelDesc = 'Z-A';

    /**
     * @param  string  $columnSelectName
     *
     * @return string|null
     */
    public function sortBy(string $columnSelectName): ?string
    {
        if ($this->sortingIsDisabled()) {
            return null;
        }

        // If single sorting is enabled and there are sorts but not the field that is being sorted,
        // then clear all the sorts
        if ($this->singleSortingIsEnabled() && $this->hasSorts() && ! $this->hasSort($columnSelectName)) {
            $this->clearSorts();
        }

        if (! $this->hasSort($columnSelectName)) {
            return $this->setSortAsc($columnSelectName);
        }

        if ($this->isSortAsc($columnSelectName)) {
            return $this->setSortDesc($columnSelectName);
        }

        $this->clearSort($columnSelectName);

        return null;
    }

    /**
     * @return Builder
     */
    public function applySorting(): Builder
    {
        if ($this->hasDefaultSort() && ! $this->hasSorts()) {
            $this->setBuilder($this->getBuilder()->orderBy($this->getDefaultSortColumn(), $this->getDefaultSortDirection()));

            return $this->getBuilder();
        }

        foreach ($this->getSorts() as $column => $direction) {
            if (! in_array($direction, ['asc', 'desc'])) {
                $direction = 'asc';
            }

            if (is_null($column = $this->getColumnBySelectName($column))) {
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
                $value = $this->getBuilder()->getGrammar()->wrap($column->getColumn() . ' as ' . $column->getColumnSelectName());
                $segments = preg_split('/\s+as\s+/i', $value);
                $this->setBuilder($this->getBuilder()->orderByRaw($segments[1] . ' ' . $direction));
            }
        }

        return $this->getBuilder();
    }
}
