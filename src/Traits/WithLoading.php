<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Rappasoft\LaravelLivewireTables\Traits\Configuration\LoadingConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Helpers\LoadingHelpers;

trait WithLoading
{
    use LoadingConfiguration,
        LoadingHelpers;

    protected bool $displayLoadingPlaceholder = false;

    protected string $loadingPlaceholderContent = 'Loading';

    protected array $loadingPlaceHolderAttributes = [];

    protected array $loadingPlaceHolderIconAttributes = [];

    protected array $loadingPlaceHolderWrapperAttributes = [];

}
