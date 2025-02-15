<?php

namespace Rappasoft\LaravelLivewireTables\Views\Columns\Traits;

trait IsSearchable
{
    protected bool $searchable = false;

    protected mixed $searchCallback = null;

    public function getSearchCallback(): ?callable
    {
        return $this->searchCallback;
    }

    public function isSearchable(): bool
    {
        return $this->hasField() && $this->searchable === true;
    }

    public function hasSearchCallback(): bool
    {
        return $this->searchCallback !== null;
    }

    public function searchable(?callable $callback = null): self
    {
        $this->searchable = true;

        $this->searchCallback = $callback;

        return $this;
    }
}
