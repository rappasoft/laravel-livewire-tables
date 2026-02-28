<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Rappasoft\LaravelLivewireTables\Traits\Configuration\LazyPlaceholderConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Helpers\LazyPlaceholderHelpers;

trait WithLazyPlaceholder
{
    use LazyPlaceholderConfiguration,
        LazyPlaceholderHelpers;

    protected bool $lazyPlaceholderEnabled = true;

    protected ?string $lazyPlaceholderView = null;
}
