<?php

namespace Rappasoft\LivewireTables\Http\Livewire\Traits;

/**
 * Trait Pagination.
 */
trait Pagination
{
    /**
     * Pagination.
     */

    /**
     * Displays per page and pagination links.
     *
     * @var bool
     */
    public $paginationEnabled = true;

    /**
     * The options to limit the amount of results per page.
     *
     * @var array
     */
    public $perPageOptions = [10, 25, 50];

    /**
     * Amount of items to show per page.
     *
     * @var int
     */
    public $perPage = 25;

    /**
     * The label for the per page filter.
     *
     * @var string
     */
    public $perPageLabel;
}
