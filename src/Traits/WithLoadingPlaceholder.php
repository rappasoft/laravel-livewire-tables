<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Rappasoft\LaravelLivewireTables\Traits\Configuration\LoadingPlaceholderConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Helpers\LoadingPlaceholderHelpers;

trait WithLoadingPlaceholder
{
    use LoadingPlaceholderConfiguration,
        LoadingPlaceholderHelpers;

    protected bool $displayLoadingPlaceholder = false;

    protected string $loadingPlaceholderContent = 'Loading';

    protected ?string $loadingPlaceholderBlade = null;

    protected array $loadingPlaceHolderAttributes = [];

    protected array $loadingPlaceHolderIconAttributes = [];

    protected array $loadingPlaceHolderWrapperAttributes = [];
}
