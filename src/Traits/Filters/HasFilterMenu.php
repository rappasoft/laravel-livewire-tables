<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Filters;

use Livewire\Attributes\Locked;
use Rappasoft\LaravelLivewireTables\Traits\Filters\Configuration\FilterMenuConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Filters\Helpers\FilterMenuHelpers;
use Rappasoft\LaravelLivewireTables\Traits\Filters\Styling\HasFilterMenuStyling;

trait HasFilterMenu
{
    use FilterMenuConfiguration,
        FilterMenuHelpers,
        HasFilterMenuStyling;

    #[Locked]
    public string $filterLayout = 'popover';

    // Entangled in JS
    public bool $filterSlideDownDefaultVisible = false;
}
