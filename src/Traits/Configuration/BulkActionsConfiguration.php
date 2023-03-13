<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Configuration;

trait BulkActionsConfiguration
{
    /**
     * @param  array<mixed>  $bulkActions
     *
     * @return self
     */
    public function setBulkActions(array $bulkActions): self
    {
        $this->bulkActions = $bulkActions;

        return $this;
    }

    /**
     * @param  bool  $status
     *
     * @return self
     */
    public function setBulkActionsStatus(bool $status): self
    {
        $this->bulkActionsStatus = $status;

        return $this;
    }

    /**
     * @return self
     */
    public function setBulkActionsEnabled(): self
    {
        $this->setBulkActionsStatus(true);

        return $this;
    }

    /**
     * @return self
     */
    public function setBulkActionsDisabled(): self
    {
        $this->setBulkActionsStatus(false);

        return $this;
    }

    /**
     * @param  bool  $status
     *
     * @return self
     */
    public function setSelectAllStatus(bool $status): self
    {
        $this->selectAll = $status;

        return $this;
    }

    /**
     * @return self
     */
    public function setSelectAllEnabled(): self
    {
        $this->setSelectAllStatus(true);

        return $this;
    }

    /**
     * @return self
     */
    public function setSelectAllDisabled(): self
    {
        $this->setSelectAllStatus(false);

        return $this;
    }

    /**
     * @param  bool  $status
     *
     * @return self
     */
    public function setHideBulkActionsWhenEmptyStatus(bool $status): self
    {
        $this->hideBulkActionsWhenEmpty = $status;

        return $this;
    }

    /**
     * @return self
     */
    public function setHideBulkActionsWhenEmptyEnabled(): self
    {
        $this->setHideBulkActionsWhenEmptyStatus(true);

        return $this;
    }

    /**
     * @return self
     */
    public function setHideBulkActionsWhenEmptyDisabled(): self
    {
        $this->setHideBulkActionsWhenEmptyStatus(false);

        return $this;
    }
}
