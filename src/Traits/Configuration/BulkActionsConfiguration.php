<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Configuration;

trait BulkActionsConfiguration
{
    /**
     * @param  array<mixed>  $bulkActions
     */
    public function setBulkActions(array $bulkActions): self
    {
        $this->bulkActions = $bulkActions;

        return $this;
    }

    public function setBulkActionsStatus(bool $status): self
    {
        $this->bulkActionsStatus = $status;

        return $this;
    }

    public function setBulkActionsEnabled(): self
    {
        $this->setBulkActionsStatus(true);

        return $this;
    }

    public function setBulkActionsDisabled(): self
    {
        $this->setBulkActionsStatus(false);

        return $this;
    }

    public function setSelectAllStatus(bool $status): self
    {
        $this->selectAll = $status;

        return $this;
    }

    public function setSelectAllEnabled(): self
    {
        $this->setSelectAllStatus(true);

        return $this;
    }

    public function setSelectAllDisabled(): self
    {
        $this->setSelectAllStatus(false);

        return $this;
    }

    public function setHideBulkActionsWhenEmptyStatus(bool $status): self
    {
        $this->hideBulkActionsWhenEmpty = $status;

        return $this;
    }

    public function setHideBulkActionsWhenEmptyEnabled(): self
    {
        $this->setHideBulkActionsWhenEmptyStatus(true);

        return $this;
    }

    public function setHideBulkActionsWhenEmptyDisabled(): self
    {
        $this->setHideBulkActionsWhenEmptyStatus(false);

        return $this;
    }

    public function setBulkActionConfirms(array $bulkActionConfirms): self
    {
        foreach ($bulkActionConfirms as $bulkAction) {
            if (! $this->hasConfirmationMessage($bulkAction)) {
                $this->setBulkActionConfirmMessage($bulkAction, $this->getBulkActionDefaultConfirmationMessage());
            }
        }

        return $this;
    }

    public function setBulkActionConfirmMessage(string $action, string $confirmationMessage): self
    {
        $this->bulkActionConfirms[$action] = $confirmationMessage;

        return $this;
    }

    public function setBulkActionConfirmMessages(array $bulkActionMessages): self
    {
        foreach ($bulkActionMessages as $bulkAction => $confirmationMessage) {
            $this->setBulkActionConfirmMessage($bulkAction, $confirmationMessage);
        }

        return $this;
    }

    public function setBulkActionDefaultConfirmationMessage(string $defaultConfirmationMessage): self
    {
        $this->bulkActionConfirmDefaultMessage = $defaultConfirmationMessage;

        return $this;
    }

    /**
     * Used to set attributes for the <th> for Bulk Actions
     */
    public function setBulkActionsThAttributes(array $bulkActionsThAttributes): self
    {
        $this->bulkActionsThAttributes = [...$this->bulkActionsThAttributes, ...$bulkActionsThAttributes];

        return $this;
    }

    /**
     * Used to set attributes for the Bulk Actions Checkbox in the <th>
     */
    public function setBulkActionsThCheckboxAttributes(array $bulkActionsThCheckboxAttributes): self
    {
        $this->bulkActionsThCheckboxAttributes = [...$this->bulkActionsThCheckboxAttributes, ...$bulkActionsThCheckboxAttributes];

        return $this;
    }

    /**
     * Used to set attributes for the Bulk Actions TD in the Row
     */
    public function setBulkActionsTdAttributes(array $bulkActionsTdAttributes): self
    {
        $this->bulkActionsTdAttributes = [...$this->bulkActionsTdAttributes, ...$bulkActionsTdAttributes];

        return $this;
    }

    /**
     * Used to set attributes for the Bulk Actions Checkbox in the Row
     */
    public function setBulkActionsTdCheckboxAttributes(array $bulkActionsTdCheckboxAttributes): self
    {
        $this->bulkActionsTdCheckboxAttributes = [...$this->bulkActionsTdCheckboxAttributes, ...$bulkActionsTdCheckboxAttributes];

        return $this;
    }
}
