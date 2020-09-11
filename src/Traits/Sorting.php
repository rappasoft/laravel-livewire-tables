<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

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
     * The default sort icon
     *
     * @var string
     */
    public $sortDefaultClass = 'text-muted fas fa-sort';

    /**
     * The sort icon when currently sorting ascending
     *
     * @var string
     */
    public $ascSortClass = 'fas fa-sort-up';

    /**
     * The sort icon when currently sorting descending
     *
     * @var string
     */
    public $descSortClass = 'fas fa-sort-down';

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
}
