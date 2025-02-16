<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Styling;

use Illuminate\View\ComponentAttributeBag;
use Livewire\Attributes\Computed;

trait HasBulkActionsStyling
{
    protected array $bulkActionsCheckboxAttributes = [];

    protected array $bulkActionsThAttributes = ['default' => true];

    protected array $bulkActionsThCheckboxAttributes = ['default' => true];

    protected array $bulkActionsTdAttributes = ['default' => true];

    protected array $bulkActionsTdCheckboxAttributes = ['default' => true];

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
        $this->setCustomAttributes('bulkActionsButtonAttributes', $bulkActionsButtonAttributes);

        return $this;
    }

    /**
     * Used to set attributes for the Bulk Actions Menu
     */
    public function setBulkActionsMenuAttributes(array $bulkActionsMenuAttributes): self
    {
        $this->setCustomAttributes('bulkActionsMenuAttributes', $bulkActionsMenuAttributes);

        return $this;
    }

    /**
     * Used to set attributes for the Bulk Actions Menu Items
     */
    public function setBulkActionsMenuItemAttributes(array $bulkActionsMenuItemAttributes): self
    {
        $this->setCustomAttributes('bulkActionsMenuItemAttributes', $bulkActionsMenuItemAttributes);

        return $this;
    }

    /**
     * Used to set attributes for the Bulk Actions TD in the Row
     */
    public function setBulkActionsTdAttributes(array $bulkActionsTdAttributes): self
    {
        $this->setCustomAttributes('bulkActionsTdAttributes', $bulkActionsTdAttributes);

        return $this;
    }

    /**
     * Used to set attributes for the Bulk Actions Checkbox in the Row
     */
    public function setBulkActionsTdCheckboxAttributes(array $bulkActionsTdCheckboxAttributes): self
    {
        $this->setCustomAttributes('bulkActionsTdCheckboxAttributes', $bulkActionsTdCheckboxAttributes);

        return $this;
    }

    /**
     * Used to set attributes for the <th> for Bulk Actions
     */
    public function setBulkActionsThAttributes(array $bulkActionsThAttributes): self
    {
        $this->setCustomAttributes('bulkActionsThAttributes', $bulkActionsThAttributes);

        return $this;
    }

    /**
     * Used to set attributes for the Bulk Actions Checkbox in the <th>
     */
    public function setBulkActionsThCheckboxAttributes(array $bulkActionsThCheckboxAttributes): self
    {
        $this->setCustomAttributes('bulkActionsThCheckboxAttributes', $bulkActionsThCheckboxAttributes);

        return $this;
    }

    /**
     * Used to set attributes for the Bulk Actions Row Buttons
     */
    public function setBulkActionsRowButtonAttributes(array $bulkActionsRowButtonAttributes): self
    {
        $this->setCustomAttributes('bulkActionsRowButtonAttributes', $bulkActionsRowButtonAttributes);

        return $this;
    }
}
