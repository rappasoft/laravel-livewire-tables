<?php

declare(strict_types=1);

namespace Rappasoft\LaravelLivewireTables\Traits;

use Rappasoft\LaravelLivewireTables\Traits\Configuration\BulkActionsConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Helpers\BulkActionsHelpers;

/**
 * Bulk actions functionality for DataTableComponent
 */
trait WithBulkActions
{
    use BulkActionsConfiguration,
        BulkActionsHelpers;

    /**
     * Whether bulk actions are enabled
     */
    public bool $bulkActionsStatus = true;

    /**
     * Whether all items are selected (entangled with JS)
     */
    public bool $selectAll = false;

    /**
     * Available bulk actions
     * @var array<string, string>
     */
    public array $bulkActions = [];

    /**
     * Bulk actions that require confirmation
     * @var array<string, string>
     */
    public array $bulkActionConfirms = [];

    /**
     * Currently selected item IDs (entangled with JS)
     * @var array<int, string>
     */
    public array $selected = [];

    /**
     * Whether to hide bulk actions dropdown when nothing selected (entangled with JS)
     */
    public bool $hideBulkActionsWhenEmpty = false;

    /**
     * Default confirmation message for bulk actions
     */
    public ?string $bulkActionConfirmDefaultMessage = null;

    /**
     * Checkbox attributes
     * @var array<string, mixed>
     */
    protected array $bulkActionsCheckboxAttributes = [];

    /**
     * TH element attributes
     * @var array<string, mixed>
     */
    protected array $bulkActionsThAttributes = ['default' => true];

    /**
     * TH checkbox attributes
     * @var array<string, mixed>
     */
    protected array $bulkActionsThCheckboxAttributes = ['default' => true];

    /**
     * TD element attributes
     * @var array<string, mixed>
     */
    protected array $bulkActionsTdAttributes = ['default' => true];

    /**
     * TD checkbox attributes
     * @var array<string, mixed>
     */
    protected array $bulkActionsTdCheckboxAttributes = ['default' => true];

    /**
     * Whether to always hide bulk actions dropdown option
     */
    protected bool $alwaysHideBulkActionsDropdownOption = false;

    /**
     * Whether to clear selected on search
     */
    protected bool $clearSelectedOnSearch = true;

    /**
     * Whether to clear selected on filter
     */
    protected bool $clearSelectedOnFilter = true;

    /**
     * Button attributes for bulk actions
     * @var array<string, mixed>
     */
    protected array $bulkActionsButtonAttributes = ['default-colors' => true, 'default-styling' => true];

    /**
     * Menu attributes for bulk actions
     * @var array<string, mixed>
     */
    protected array $bulkActionsMenuAttributes = ['default-colors' => true, 'default-styling' => true];

    /**
     * Menu item attributes for bulk actions
     * @var array<string, mixed>
     */
    protected array $bulkActionsMenuItemAttributes = ['default-colors' => true, 'default-styling' => true];

    /**
     * Whether to delay select all (entangled with JS)
     */
    public bool $delaySelectAll = false;

    /**
     * Get available bulk actions
     *
     * @return array<string, string>
     */
    public function bulkActions(): array
    {
        return property_exists($this, 'bulkActions') ? $this->bulkActions : [];
    }
}
