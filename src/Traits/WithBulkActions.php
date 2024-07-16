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

    protected array $bulkActionsCheckboxAttributes = [];

    protected array $bulkActionsThAttributes = ['default' => true];

    protected array $bulkActionsThCheckboxAttributes = ['default' => true];

    protected array $bulkActionsTdAttributes = ['default' => true];

    protected array $bulkActionsTdCheckboxAttributes = ['default' => true];

    protected bool $alwaysHideBulkActionsDropdownOption = false;

    public bool $clearSelectedOnSearch = true;

    public bool $clearSelectedOnFilter = true;

    protected array $bulkActionsButtonAttributes = ['default-colors' => true, 'default-styling' => true];

    protected array $bulkActionsMenuAttributes = ['default-colors' => true, 'default-styling' => true];

    protected array $bulkActionsMenuItemAttributes = ['default-colors' => true, 'default-styling' => true];

    public function bulkActions(): array
    {
        return property_exists($this, 'bulkActions') ? $this->bulkActions : [];
    }
}
