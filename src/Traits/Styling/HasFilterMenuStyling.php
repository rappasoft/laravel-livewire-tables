<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Styling;

use Closure;
use Livewire\Attributes\Locked;
use Rappasoft\LaravelLivewireTables\Traits\Styling\Configuration\FilterMenuStylingConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Styling\Helpers\FilterMenuStylingHelpers;

trait HasFilterMenuStyling
{
    use FilterMenuStylingConfiguration,
        FilterMenuStylingHelpers;

    #[Locked]
    public string $filterLayout = 'popover';

    // Entangled in JS
    public bool $filterSlideDownDefaultVisible = false;

    protected array $filterPopoverAttributes = ['class' => '', 'default-width' => true, 'default-colors' => true, 'default-styling' => true];

    protected array $filterSlidedownWrapperAttributes = ['class' => '', 'default-colors' => true, 'default-styling' => true];

    protected ?Closure $filterSlidedownRowCallback;
}
