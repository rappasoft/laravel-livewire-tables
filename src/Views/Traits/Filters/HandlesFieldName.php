<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Filters;

trait HandlesFieldName
{
    protected ?string $field_name;

    public function setField(string $field_name): self
    {
        $this->field_name = $field_name;

        return $this;
    }

    public function hasField(): bool
    {
        return isset($this->field_name);

    }

    public function getField(): string
    {
        return $this->field_name;

    }
}
