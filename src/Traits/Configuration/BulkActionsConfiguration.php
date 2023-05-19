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
}
