<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Helpers;

use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Computed;

trait QueryHelpers
{
    public function getBuilder(): Builder
    {
        if (! isset($this->builder)) {
            $this->setBuilder($this->builder());
        }

        return $this->builder;
    }

    public function hasPrimaryKey(): bool
    {
        return isset($this->primaryKey) && $this->primaryKey !== null;
    }

    /**
     * @return mixed
     */
    #[Computed]
    public function getPrimaryKey()
    {
        return $this->primaryKey;
    }

    /**
     * @return array<mixed>
     */
    public function getRelationships(): array
    {
        return $this->relationships;
    }

    /**
     * @return array<mixed>
     */
    public function getAdditionalSelects(): array
    {
        return $this->additionalSelects;
    }

    public function hasExtraWiths(): bool
    {
        return ! empty($this->extraWiths);
    }

    public function getExtraWiths(): array
    {
        return $this->extraWiths;
    }

    public function hasExtraWithCounts(): bool
    {
        return ! empty($this->extraWithCounts);
    }

    public function getExtraWithCounts(): array
    {
        return $this->extraWithCounts;
    }

    public function hasExtraWithSums(): bool
    {
        return ! empty($this->extraWithSums);
    }

    public function getExtraWithSums(): array
    {
        return $this->extraWithSums;
    }

    public function hasExtraWithAvgs(): bool
    {
        return ! empty($this->extraWithAvgs);
    }

    public function getExtraWithAvgs(): array
    {
        return $this->extraWithAvgs;
    }

    public function getEagerLoadAllRelationsStatus(): bool
    {
        return $this->eagerLoadAllRelationsStatus;
    }

    public function eagerLoadAllRelationsIsEnabled(): bool
    {
        return $this->getEagerLoadAllRelationsStatus() === true;
    }

    public function eagerLoadAllRelationsIsDisabled(): bool
    {
        return $this->getEagerLoadAllRelationsStatus() === false;
    }
}
