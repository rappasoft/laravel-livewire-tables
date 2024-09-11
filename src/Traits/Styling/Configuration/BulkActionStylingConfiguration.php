<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Styling\Configuration;

trait BulkActionStylingConfiguration
{
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
}
