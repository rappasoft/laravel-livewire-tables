<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Styling;

use Rappasoft\LaravelLivewireTables\Traits\Styling\Configuration\PaginationStylingConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Styling\Helpers\PaginationStylingHelpers;

trait HasPaginationStyling
{
    use PaginationStylingConfiguration,
        PaginationStylingHelpers;

    protected array $perPageFieldAttributes = ['default-styling' => true, 'default-colors' => true, 'class' => ''];

    protected array $paginationWrapperAttributes = ['class' => ''];
}
