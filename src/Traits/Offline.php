<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

/**
 * Trait Offline.
 */
trait Offline
{
    /**
     * Offline.
     */

    /**
     * Whether or not to display an offline message when there is no connection.
     *
     * @var bool
     */
    public $offlineIndicator = true;

    /**
     * The message to display when offline.
     *
     * @var string
     */
    public $offlineMessage;
}
