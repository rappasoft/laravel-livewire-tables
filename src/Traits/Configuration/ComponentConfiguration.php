<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Configuration;

trait ComponentConfiguration
{
    public function setPrimaryKey(?string $key): self
    {
        $this->primaryKey = $key;

        return $this;
    }

    /**
     * Set the empty message
     */
    public function setEmptyMessage(string $message): self
    {
        $this->emptyMessage = $message;

        return $this;
    }

    public function setOfflineIndicatorStatus(bool $status): self
    {
        $this->offlineIndicatorStatus = $status;

        return $this;
    }

    public function setOfflineIndicatorEnabled(): self
    {
        $this->setOfflineIndicatorStatus(true);

        return $this;
    }

    public function setOfflineIndicatorDisabled(): self
    {
        $this->setOfflineIndicatorStatus(false);

        return $this;
    }

    public function setEagerLoadAllRelationsStatus(bool $status): self
    {
        $this->eagerLoadAllRelationsStatus = $status;

        return $this;
    }

    public function setEagerLoadAllRelationsEnabled(): self
    {
        $this->setEagerLoadAllRelationsStatus(true);

        return $this;
    }

    public function setEagerLoadAllRelationsDisabled(): self
    {
        $this->setEagerLoadAllRelationsStatus(false);

        return $this;
    }

    /**
     * Allows adding a single set of additional selects to the query
     */
    public function setAdditionalSelects(string|array $selects): self
    {
        if (! is_array($selects)) {
            $selects = [$selects];
        }

        $this->additionalSelects = $selects;

        return $this;
    }

    /**
     * Allows appending more additional selects
     */
    public function addAdditionalSelects(string|array $selects): self
    {
        if (! is_array($selects)) {
            $selects = [$selects];
        }
        $this->additionalSelects = [...$this->additionalSelects, ...$selects];

        return $this;
    }

    public function setDataTableFingerprint(string $dataTableFingerprint): self
    {
        $this->dataTableFingerprint = $dataTableFingerprint;

        return $this;
    }
}
