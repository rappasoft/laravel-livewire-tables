<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Styling;

use Rappasoft\LaravelLivewireTables\Traits\Styling\Configuration\LoadingPlaceholderStylingConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Styling\Helpers\LoadingPlaceholderStylingHelpers;

trait HasLoadingPlaceholderStyling
{
    use LoadingPlaceholderStylingConfiguration,
        LoadingPlaceholderStylingHelpers;

    protected array $loadingPlaceHolderAttributes = [];

    protected array $loadingPlaceHolderIconAttributes = [];

    protected array $loadingPlaceHolderWrapperAttributes = [];

    protected array $loadingPlaceHolderRowAttributes = [];

    protected array $loadingPlaceHolderCellAttributes = ['class' => '', 'default' => true];
}
