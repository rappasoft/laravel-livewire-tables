<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

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
     * Whether or not the per page checker is visible
     * Can have pagination on with the per page off.
     *
     * @var bool
     */
    public $perPageEnabled = true;

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

    /**
     * The label for shown string.
     *
     * @var string
     */
    public $shownLabel='Showing';

    /**
     * The label for results string.
     *
     * @var string
     */
    public $resultsLable='results';

    /**
     * The label for out of string.
     *
     * @var string
     */
    public $outOfLabel='out of';

    /**
     * The label for to string.
     *
     * @var string
     */
    public $toLabel='to';

    /**
     * https://laravel-livewire.com/docs/pagination
     * Resetting Pagination After Filtering Data.
     */
    public function updatingSearch(): void
    {
        $this->resetPage();
    }
}
