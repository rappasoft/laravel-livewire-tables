<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Rappasoft\LaravelLivewireTables\Traits\Configuration\BulkActionsConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Helpers\BulkActionsHelpers;

trait WithBulkActions
{
    use BulkActionsConfiguration,
        BulkActionsHelpers;

    public bool $bulkActionsStatus = true;

    public bool $selectAll = false;

    public array $bulkActions = [];

    public array $bulkActionConfirms = [];

    public array $selected = [];

    public bool $hideBulkActionsWhenEmpty = false;

    public ?string $bulkActionConfirmDefaultMessage;

    public function bulkActions(): array
    {
        return property_exists($this, 'bulkActions') ? $this->bulkActions : [];
    }
}
