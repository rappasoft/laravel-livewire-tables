<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Styling\Helpers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\View\ComponentAttributeBag;
use Livewire\Attributes\Computed;

trait BulkActionStylingHelpers
{
    /**
     * Used to get attributes for the Bulk Actions Button
     *
     * @return array<mixed>
     */
    #[Computed]
    public function getBulkActionsButtonAttributes(): array
    {
        return $this->getCustomAttributes('bulkActionsButtonAttributes', true);

    }

    /**
     * Used to get attributes for the Bulk Actions Menu (Dropdown)
     *
     * @return array<mixed>
     */
    #[Computed]
    public function getBulkActionsMenuAttributes(): array
    {
        return $this->getCustomAttributes('bulkActionsMenuAttributes', true, false);

    }

    /**
     * Used to get attributes for the items in the Bulk Actions Menu (Dropdown)
     *
     * @return array<mixed>
     */
    #[Computed]
    public function getBulkActionsMenuItemAttributes(): array
    {
        return $this->getCustomAttributes('bulkActionsMenuItemAttributes', true, false);

    }

    /**
     * Used to get attributes for the <th> for Bulk Actions
     *
     * @return array<mixed>
     */
    #[Computed]
    public function getBulkActionsThAttributes(): array
    {
        return $this->getCustomAttributes('bulkActionsThAttributes');

    }

    /**
     * Used to check if the Bulk Actions TH has any attributes (supports historic approach)
     */
    #[Computed]
    public function hasBulkActionsThAttributes(): bool
    {
        return $this->getBulkActionsThAttributes() != ['default' => true, 'default-colors' => false, 'default-styling' => false];
    }

    /**
     * Used to get attributes for the Checkbox for Bulk Actions TH
     *
     * @return array<mixed>
     */
    public function getBulkActionsThCheckboxAttributes(): array
    {
        return $this->getCustomAttributes('bulkActionsThCheckboxAttributes');
    }

    /**
     * Used to get attributes for the Bulk Actions TD
     *
     * @return array<mixed>
     */
    public function getBulkActionsTdAttributesNew(string $rowPrimaryKey): array
    {
        $default = [
            'wire:key' => $this->getTableName().'-tbody-td-bulk-actions-'.$rowPrimaryKey,
            ':displayMinimisedOnReorder' => 'true',
        ];

        return array_merge($default, $this->getBulkActionsTdAttributes());
    }

    /**
     * Used to get attributes for the Bulk Actions TD
     *
     * @return array<mixed>
     */
    public function getBulkActionsTdAttributes(): array
    {
        return $this->getCustomAttributes('bulkActionsTdAttributes');
    }

    /**
     * Used to get attributes for the Bulk Actions TD
     *
     * @return array<mixed>
     */
    public function getBulkActionsTdCheckboxAttributes(): array
    {

        return $this->getCustomAttributes('bulkActionsTdCheckboxAttributes');

    }

    public function getBulkActionsTdCheckboxAttributesNew(string $rowPrimaryKey): array
    {
        $default = [
            'x-cloak' => '',
            'x-show' => '!currentlyReorderingStatus',
            'x-model' => 'selectedItems',
            'wire:key' => $this->getTableName().'-selectedItems-'.$rowPrimaryKey,
            'id' => $this->getTableName().'-row-bac-'.$rowPrimaryKey,
            'value' => $rowPrimaryKey,
            'wire:loading.attr.delay' => 'disabled',
            'type' => 'checkbox',
        ];

        return array_merge($default, $this->getBulkActionsTdCheckboxAttributes());

    }

    /**
     * Used to get attributes for the Bulk Actions Row Buttons
     *
     * @return array<mixed>
     */
    #[Computed]
    public function getBulkActionsRowButtonAttributes(): array
    {
        return $this->getCustomAttributes('bulkActionsRowButtonAttributes', true);

    }

    #[Computed]
    public function getBulkActionsRowButtonAttributesBag(): ComponentAttributeBag
    {
        return $this->getCustomAttributesBagFromArray($this->getBulkActionsRowButtonAttributes());
    }
}
