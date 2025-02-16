<?php

namespace Rappasoft\LaravelLivewireTables\Views\Columns\Traits;

use Illuminate\Support\Collection;

trait HasRelations
{
    // An array of relationships: i.e. address.group.name => ['address', 'group']
    protected array $relations = [];

    protected bool $eagerLoadRelations = false;

    public function isBaseColumn(): bool
    {
        return ! $this->hasRelations() && $this->hasField();
    }

    public function hasRelations(): bool
    {
        return $this->getRelations()->count() > 0;
    }

    public function getRelations(): Collection
    {
        return collect($this->relations);
    }

    public function getRelationString(): ?string
    {
        if ($this->hasRelations()) {
            return $this->getRelations()->implode('.');
        }

        return null;
    }

    public function eagerLoadRelations(): self
    {
        $this->eagerLoadRelations = true;

        return $this;
    }

    public function eagerLoadRelationsIsEnabled(): bool
    {
        return $this->eagerLoadRelations === true;
    }
}
