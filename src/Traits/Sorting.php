<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

/**
 * Trait Sorting.
 */
trait Sorting
{
    /**
     * Sorting.
     */

    /**
     * The initial field to be sorting by.
     *
     * @var string
     */
    public $sortField = 'id';

    /**
     * The initial direction to sort.
     *
     * @var bool
     */
    public $sortDirection = 'asc';

    /**
     * The default sort icon.
     *
     * @var string
     */
    public $sortDefaultIcon = '<i class="text-muted fas fa-sort"></i>';

    /**
     * The sort icon when currently sorting ascending.
     *
     * @var string
     */
    public $ascSortIcon = '<i class="fas fa-sort-up"></i>';

    /**
     * The sort icon when currently sorting descending.
     *
     * @var string
     */
    public $descSortIcon = '<i class="fas fa-sort-down"></i>';

    /**
     * @param $attribute
     */
    public function sort($attribute): void
    {
        if ($this->sortField !== $attribute) {
            $this->sortDirection = 'asc';
        } else {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        }

        $this->sortField = $attribute;
    }

    /**
     * @param  Builder  $builder
     *
     * @return string
     */
    protected function getSortField(Builder $builder): string
    {
        if (Str::contains($this->sortField, '.')) {
            $relationship = $this->relationship($this->sortField);

            return $this->attribute($builder, $relationship->name, $relationship->attribute);
        }

        return $this->sortField;
    }
}
