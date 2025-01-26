<?php

namespace Rappasoft\LaravelLivewireTables\Views\Filters\Traits;

trait HandlesFieldName
{
    protected ?string $fieldName;

    public function setFieldName(string $fieldName): self
    {
        $this->fieldName = $fieldName;

        return $this;
    }

    public function hasFieldName(): bool
    {
        return isset($this->fieldName);

    }

    public function getFieldName(): string
    {
        return $this->fieldName;

    }
}
