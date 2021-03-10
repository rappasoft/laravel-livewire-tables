<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

/**
 * Trait Search.
 */
trait Search
{
    /**
     * The initial search string.
     *
     * @var string
     */
    public $search = '';

    /**
     * Method to search by: debounce or lazy.
     * @var string
     */
    public $searchUpdateMethod = 'debounce';

    /**
     * Whether or not searching is enabled.
     *
     * @var bool
     */
    public $searchEnabled = true;

    /**
     * false = disabled
     * int = Amount of time in ms to wait to send the search query and refresh the table.
     *
     * @var int
     */
    public $searchDebounce = 350;

    /**
     * A button to clear the search box.
     *
     * @var bool
     */
    public $clearSearchButton = false;

    /**
     * The class applied to the clear button
     *
     * @var bool
     */
    public $clearSearchButtonClass = 'btn btn-outline-dark';

    /**
     * Resets the search string.
     */
    public function clearSearch(): void
    {
        $this->search = '';
    }
}
