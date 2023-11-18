<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Rappasoft\LaravelLivewireTables\Traits\Configuration\BladeManagementConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Helpers\BladeManagementHelpers;

trait WithBladeManagement
{
    use BladeManagementConfiguration,
    BladeManagementHelpers;

}