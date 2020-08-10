<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

/**
 * Trait Loading.
 */
trait Loading
{
    /**
     * Loading.
     */

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
}
