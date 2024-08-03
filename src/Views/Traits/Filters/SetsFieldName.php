<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Filters;

trait SetsFieldName
{
    protected ?string $field_name;

    public function setField(string $field_name): self
    {
        $this->field_name = $field_name;

        return $this;
    }
}