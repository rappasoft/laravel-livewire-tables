<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Styling;

use Rappasoft\LaravelLivewireTables\Traits\Styling\Configuration\SearchFieldStylingConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Styling\Helpers\SearchFieldStylingHelpers;

trait HasSearchFieldStyling
{
    use SearchFieldStylingConfiguration,
    SearchFieldStylingHelpers;
    
    protected array $searchFieldAttributes = [];

    protected bool $searchIconSet = false;

    protected ?string $searchIcon = null;

    protected array $searchIconAttributes = ['default-colors' => true, 'default-styling' => true];
    
}