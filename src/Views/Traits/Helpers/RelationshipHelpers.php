<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Helpers;

use Illuminate\Support\Collection;

trait RelationshipHelpers
{
    /**
     * @return bool
     */
    public function isBaseColumn(): bool
    {
        return ! $this->hasRelations() && $this->hasField();
    }

    /**
     * @return bool
     */
    public function hasRelations(): bool
    {
        return $this->getRelations()->count();
    }

    /**
     * @return Collection
     */
    public function getRelations(): Collection
    {
        return collect($this->relations);
    }

    /**
     * @return string|null
     */
    public function getRelationString(): ?string
    {
        if ($this->hasRelations()) {
            return $this->getRelations()->implode('.');
        }

        return null;
    }
}
