<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

/**
 * Trait Loading.
 */
trait Loading
{

    /**
     * Whether or not to show a loading indicator when searching.
     *
     * @var bool
     */
    public $loadingIndicator = true;

    /**
     * Whether or not to disable the search bar when it is searching/loading new data.
     *
     * @var bool
     */
    public $disableSearchOnLoading = false;

    /**
     * When the table is loading, hide all data but the loading row
     * Otherwise the loading row gets shown above the data (makes the page less jumpy)
     *
     * @var bool
     */
    public $collapseDataOnLoading = false;
}
