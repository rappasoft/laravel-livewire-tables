<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

/**
 * Trait Search.
 */
trait Search
{
    /**
     * Search.
     */


    /**
     * Whether search work:  debounce or lazy
     * @var string
     */
    public $searchType = 'debounce';

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
     * Whether or not to disable the search bar when it is searching/loading new data.
     *
     * @var bool
     */
    public $disableSearchOnLoading = true;

    /**
     * The initial search string.
     *
     * @var string
     */
    public $search = '';

    /**
     * The placeholder for the search box.
     *
     * @var string
     */
    public $searchLabel;

    /**
     * The message to display when there are no results.
     *
     * @var string
     */
    public $noResultsMessage;
}
