<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Styling;

use Livewire\Attributes\Locked;
use Rappasoft\LaravelLivewireTables\Traits\Styling\Configuration\PaginationStylingConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Styling\Helpers\PaginationStylingHelpers;

trait HasPaginationStyling
{
    use PaginationStylingConfiguration,
        PaginationStylingHelpers;

    // Used In Frontend
    #[Locked]
    public string $paginationTheme = 'tailwind';

    // Used In Frontend
    protected array $perPageFieldAttributes = ['class' => '', 'default-colors' => true, 'default-styling' => true];

    // Used In Frontend
    protected array $perPageWrapperAttributes = ['class' => '', 'default-colors' => true, 'default-styling' => true];

    // Used In Frontend
    protected array $paginationWrapperAttributes = ['class' => ''];

    // Used In Frontend
    protected ?string $customPaginationBlade;
}
