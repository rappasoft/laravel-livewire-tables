<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Rappasoft\LaravelLivewireTables\Traits\Configuration\SessionStorageConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Helpers\SessionStorageHelpers;

trait WithSessionStorage
{
    use SessionStorageConfiguration,
        SessionStorageHelpers;

    public array $sessionStorageStatus = [
        'columnselect' => true,
        'filters' => false,
    ];
}
