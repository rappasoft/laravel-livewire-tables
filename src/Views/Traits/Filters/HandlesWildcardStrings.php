<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Filters;

use Illuminate\Database\Eloquent\Builder;

trait HandlesWildcardStrings
{
    use HandlesFieldName;

    public function contains(?string $field = null): self
    {
        if (isset($field)) {
            $this->setField($field);
        }
        $this->filter(function (Builder $builder, string $value) {
            $builder->whereLike($this->field_name, '%'.$value.'%');
        });

        return $this;
    }

    public function notContains(?string $field = null): self
    {
        if (isset($field)) {
            $this->setField($field);
        }
        $this->filter(function (Builder $builder, string $value) {
            $builder->whereNotLike($this->field_name, '%'.$value.'%');
        });

        return $this;
    }

    public function startsWith(?string $field = null): self
    {
        if (isset($field)) {
            $this->setField($field);
        }

        $this->filter(function (Builder $builder, string $value) {
            $builder->whereLike($this->field_name, $value.'%');
        });

        return $this;
    }

    public function notStartsWith(?string $field = null): self
    {
        if (isset($field)) {
            $this->setField($field);
        }

        $this->filter(function (Builder $builder, string $value) {
            $builder->whereNotLike($this->field_name, $value.'%');
        });

        return $this;
    }

    public function endsWith(?string $field = null): self
    {
        if (isset($field)) {
            $this->setField($field);
        }
        $this->filter(function (Builder $builder, string $value) {
            $builder->whereLike($this->field_name, '%'.$value);
        });

        return $this;
    }

    public function notEndsWith(?string $field = null): self
    {
        if (isset($field)) {
            $this->setField($field);
        }
        $this->filter(function (Builder $builder, string $value) {
            $builder->whereNotLike($this->field_name, '%'.$value);
        });

        return $this;
    }
}
