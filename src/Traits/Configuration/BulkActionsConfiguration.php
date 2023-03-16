<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Configuration;

trait BulkActionsConfiguration
{
    /**
     * @param  array  $bulkActions
     *
     * @return $this
     */
    public function setBulkActions(array $bulkActions): self
    {
        $this->bulkActions = $bulkActions;

        return $this;
    }

    /**
     * @param  bool  $status
     *
     * @return $this
     */
    public function setBulkActionsStatus(bool $status): self
    {
        $this->bulkActionsStatus = $status;

        return $this;
    }

    /**
     * @return $this
     */
    public function setBulkActionsEnabled(): self
    {
        $this->setBulkActionsStatus(true);

        return $this;
    }

    /**
     * @return $this
     */
    public function setBulkActionsDisabled(): self
    {
        $this->setBulkActionsStatus(false);

        return $this;
    }

    /**
     * @param  bool  $status
     *
     * @return $this
     */
    public function setSelectAllStatus(bool $status): self
    {
        $this->selectAll = $status;

        return $this;
    }

    /**
     * @return $this
     */
    public function setSelectAllEnabled(): self
    {
        $this->setSelectAllStatus(true);

        return $this;
    }

    /**
     * @return $this
     */
    public function setSelectAllDisabled(): self
    {
        $this->setSelectAllStatus(false);

        return $this;
    }

    /**
     * @param  bool  $status
     *
     * @return $this
     */
    public function setHideBulkActionsWhenEmptyStatus(bool $status): self
    {
        $this->hideBulkActionsWhenEmpty = $status;

        return $this;
    }

    /**
     * @return $this
     */
    public function setHideBulkActionsWhenEmptyEnabled(): self
    {
        $this->setHideBulkActionsWhenEmptyStatus(true);

        return $this;
    }

    /**
     * @return $this
     */
    public function setHideBulkActionsWhenEmptyDisabled(): self
    {
        $this->setHideBulkActionsWhenEmptyStatus(false);

        return $this;
    }
}
