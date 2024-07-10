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

    public function setExtraWiths(array $extraWiths): self
    {
        $this->extraWiths = $extraWiths;

        return $this;
    }

    public function addExtraWith(string $extraWith): self
    {
        $this->extraWiths[] = $extraWith;

        return $this;
    }

    public function addExtraWiths(array $extraWiths): self
    {
        $this->extraWiths = [...$this->extraWiths, ...$extraWiths];

        return $this;
    }

    public function setExtraWithCounts(array $extraWithCounts): self
    {
        $this->extraWithCounts = $extraWithCounts;

        return $this;
    }

    public function addExtraWithCount(string $extraWithCount): self
    {
        $this->extraWithCounts[] = $extraWithCount;

        return $this;
    }

    public function addExtraWithCounts(array $extraWithCounts): self
    {
        $this->extraWithCounts = [...$this->extraWithCounts, ...$extraWithCounts];

        return $this;
    }

    public function addExtraWithSum(string $relationship, string $column): self
    {
        $this->extraWithSums[] = ['table' => $relationship, 'field' => $column];

        return $this;
    }

    public function addExtraWithAvg(string $relationship, string $column): self
    {
        $this->extraWithAvgs[] = ['table' => $relationship, 'field' => $column];

        return $this;
    }
}
