<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Rappasoft\LaravelLivewireTables\Traits\Configuration\LoadingConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Helpers\LoadingHelpers;

trait WithLoading
{
    use LoadingConfiguration,
        LoadingHelpers;

    /**
     * Whether a loading process is visualized
     *
     * @var bool
     */
    protected bool $loading = true;

    /**
     * https://laravel-livewire.com/docs/2.x/loading-states#delaying-loading
     * Whether a loading process is visualized with a delay.
     *
     * @var bool
     */
    protected bool $loadingDelay = true;

    /**
     * https://laravel-livewire.com/docs/2.x/loading-states#delaying-loading
     *
     * @var string
     */
    protected string $loadingDelayModifier = '';
}
