<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Rappasoft\LaravelLivewireTables\Traits\Configuration\BulkActionsConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Helpers\BulkActionsHelpers;
use Rappasoft\LaravelLivewireTables\Traits\Styling\HasBulkActionsStyling;

trait WithBulkActions
{
    use BulkActionsConfiguration,
        BulkActionsHelpers,
        HasBulkActionsStyling;

    public bool $bulkActionsStatus = true;

    // Entangled in JS
    public bool $selectAll = false;

    public array $bulkActions = [];

    public array $bulkActionConfirms = [];

    // Entangled in JS
    public array $selected = [];

    // Entangled in JS
    public bool $hideBulkActionsWhenEmpty = false;

    public ?string $bulkActionConfirmDefaultMessage;

    protected bool $alwaysHideBulkActionsDropdownOption = false;

    protected bool $clearSelectedOnSearch = true;

    protected bool $clearSelectedOnFilter = true;

    // Entangled in JS
    public bool $delaySelectAll = false;

    public function bulkActions(): array
    {
        return property_exists($this, 'bulkActions') ? $this->bulkActions : [];
    }
}
