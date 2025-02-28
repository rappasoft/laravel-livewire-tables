<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Styling;

use Illuminate\View\ComponentAttributeBag;
use Livewire\Attributes\Computed;

trait HasBulkActionsStyling
{
    protected array $bulkActionsCheckboxAttributes = [];

    protected array $bulkActionsThAttributes = ['default' => null, 'default-colors' => null, 'default-styling' => null];

    protected array $bulkActionsThCheckboxAttributes = ['default' => null, 'default-colors' => null, 'default-styling' => null];

    protected array $bulkActionsTdAttributes = ['default' => null, 'default-colors' => null, 'default-styling' => null];

    protected array $bulkActionsTdCheckboxAttributes = ['default' => null, 'default-colors' => null, 'default-styling' => null];

    protected array $bulkActionsButtonAttributes = ['default-colors' => true, 'default-styling' => true];

    protected array $bulkActionsMenuAttributes = ['default-colors' => true, 'default-styling' => true];

    protected array $bulkActionsMenuItemAttributes = ['default-colors' => true, 'default-styling' => true];

    protected array $bulkActionsRowButtonAttributes = ['default-colors' => true, 'default-styling' => true];

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
        return $this->getCustomAttributesNew('bulkActionsThAttributes', true, true);

    }

    /**
     * Used to check if the Bulk Actions TH has any attributes (supports historic approach)
     */
    #[Computed]
    public function hasBulkActionsThAttributes(): bool
    {
        return $this->getBulkActionsThAttributes() != ['default' => true, 'default-colors' => true, 'default-styling' => true];
    }

    /**
     * Used to get attributes for the Checkbox for Bulk Actions TH
     *
     * @return array<mixed>
     */
    public function getBulkActionsThCheckboxAttributes(): array
    {
        return $this->getCustomAttributesNew('bulkActionsThCheckboxAttributes', true, true);

    }

    /**
     * Used to get attributes for the Bulk Actions TD
     *
     * @return array<mixed>
     */
    #[Computed]
    public function getBulkActionsTdAttributes(): array
    {
        return $this->getCustomAttributesNew('bulkActionsTdAttributes', true, true);
    }

    /**
     * Used to get attributes for the Bulk Actions TD
     *
     * @return array<mixed>
     */
    #[Computed]
    public function getBulkActionsTdCheckboxAttributes(): array
    {
        return array_merge(
            [
                'x-show' => '!currentlyReorderingStatus',
                'x-model' => 'selectedItems',
                'wire:loading.attr.delay' => 'disabled',
                'type' => 'checkbox',
            ],
            $this->getCustomAttributesNew('bulkActionsTdCheckboxAttributes', true, true)
        );
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

    /**
     * Used to set attributes for the Bulk Actions Menu Button
     */
    public function setBulkActionsButtonAttributes(array $bulkActionsButtonAttributes): self
    {
        return $this->setCustomAttributes('bulkActionsButtonAttributes', $bulkActionsButtonAttributes);
    }

    /**
     * Used to set attributes for the Bulk Actions Menu
     */
    public function setBulkActionsMenuAttributes(array $bulkActionsMenuAttributes): self
    {
        return $this->setCustomAttributes('bulkActionsMenuAttributes', $bulkActionsMenuAttributes);
    }

    /**
     * Used to set attributes for the Bulk Actions Menu Items
     */
    public function setBulkActionsMenuItemAttributes(array $bulkActionsMenuItemAttributes): self
    {
        return $this->setCustomAttributes('bulkActionsMenuItemAttributes', $bulkActionsMenuItemAttributes);
    }

    /**
     * Used to set attributes for the Bulk Actions TD in the Row
     */
    public function setBulkActionsTdAttributes(array $bulkActionsTdAttributes): self
    {
        return $this->setCustomAttributesDefaults('bulkActionsTdAttributes', $bulkActionsTdAttributes);

    }

    /**
     * Used to set attributes for the Bulk Actions Checkbox in the Row
     */
    public function setBulkActionsTdCheckboxAttributes(array $bulkActionsTdCheckboxAttributes): self
    {
        return $this->setCustomAttributesDefaults('bulkActionsTdCheckboxAttributes', $bulkActionsTdCheckboxAttributes);
    }

    /**
     * Used to set attributes for the <th> for Bulk Actions
     */
    public function setBulkActionsThAttributes(array $bulkActionsThAttributes): self
    {
        return $this->setCustomAttributesDefaults('bulkActionsThAttributes', $bulkActionsThAttributes);
    }

    /**
     * Used to set attributes for the Bulk Actions Checkbox in the <th>
     */
    public function setBulkActionsThCheckboxAttributes(array $bulkActionsThCheckboxAttributes): self
    {
        return $this->setCustomAttributesDefaults('bulkActionsThCheckboxAttributes', $bulkActionsThCheckboxAttributes);
    }

    /**
     * Used to set attributes for the Bulk Actions Row Buttons
     */
    public function setBulkActionsRowButtonAttributes(array $bulkActionsRowButtonAttributes): self
    {
        return $this->setCustomAttributes('bulkActionsRowButtonAttributes', $bulkActionsRowButtonAttributes);
    }
}
