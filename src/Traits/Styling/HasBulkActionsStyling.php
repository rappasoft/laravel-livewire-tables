<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Styling;

use Rappasoft\LaravelLivewireTables\Traits\Styling\Configuration\BulkActionStylingConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Styling\Helpers\BulkActionStylingHelpers;

trait HasBulkActionsStyling
{
    use BulkActionStylingConfiguration,
        BulkActionStylingHelpers;

    protected array $bulkActionsCheckboxAttributes = [];

    protected array $bulkActionsThAttributes = ['default' => true];

    protected array $bulkActionsThCheckboxAttributes = ['default' => true];

    protected array $bulkActionsTdAttributes = ['default' => true];

    protected array $bulkActionsTdCheckboxAttributes = ['default' => true];

    protected array $bulkActionsButtonAttributes = ['default-colors' => true, 'default-styling' => true];

    protected array $bulkActionsMenuAttributes = ['default-colors' => true, 'default-styling' => true];

    protected array $bulkActionsMenuItemAttributes = ['default-colors' => true, 'default-styling' => true];
}
