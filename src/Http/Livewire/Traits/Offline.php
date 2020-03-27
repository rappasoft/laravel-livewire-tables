<?php

namespace Rappasoft\LivewireTables\Http\Livewire\Traits;

/**
 * Trait Offline
 *
 * @package Rappasoft\LivewireTables\Http\Livewire\Traits
 */
trait Offline
{

    /**
     * Offline
     */

    /**
     * Whether or not to display an offline message when there is no connection
     *
     * @var bool
     */
    public $offlineIndicator = true;

    /**
     * The message to display when offline
     *
     * @var string
     */
    public $offlineMessage;
}
