<?php

namespace Rappasoft\LaravelLivewireTables\Views\Filters\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HandlesWildcardStrings
{
    use HandlesApplyingFilter;

    /**
     * pgsql "like" is case-sensitive, every other supported driver's isn't
     */
    private function likeOperator(Builder $builder): string
    {
        return $builder->getModel()->getConnection()->getDriverName() === 'pgsql' ? 'ilike' : 'like';
    }

    public function contains(?string $fieldName = null): self
    {
        if ($this->shouldApplyFilter($fieldName)) {
            $this->filter(function (Builder $builder, string $value) {
                $builder->where($this->getFieldName(), $this->likeOperator($builder), '%'.$value.'%');
            });
        }

        return $this;
    }

    public function notContains(?string $fieldName = null): self
    {
        if ($this->shouldApplyFilter($fieldName)) {
            $this->filter(function (Builder $builder, string $value) {
                $builder->whereNot($this->getFieldName(), $this->likeOperator($builder), '%'.$value.'%');
            });
        }

        return $this;
    }

    public function startsWith(?string $fieldName = null): self
    {
        if ($this->shouldApplyFilter($fieldName)) {
            $this->filter(function (Builder $builder, string $value) {
                $builder->where($this->getFieldName(), $this->likeOperator($builder), $value.'%');
            });
        }

        return $this;
    }

    public function notStartsWith(?string $fieldName = null): self
    {
        if ($this->shouldApplyFilter($fieldName)) {
            $this->filter(function (Builder $builder, string $value) {
                $builder->whereNot($this->getFieldName(), $this->likeOperator($builder), $value.'%');
            });
        }

        return $this;
    }

    public function endsWith(?string $fieldName = null): self
    {
        if ($this->shouldApplyFilter($fieldName)) {
            $this->filter(function (Builder $builder, string $value) {
                $builder->where($this->getFieldName(), $this->likeOperator($builder), '%'.$value);
            });
        }

        return $this;
    }

    public function notEndsWith(?string $fieldName = null): self
    {
        if ($this->shouldApplyFilter($fieldName)) {
            $this->filter(function (Builder $builder, string $value) {
                $builder->whereNot($this->getFieldName(), $this->likeOperator($builder), '%'.$value);
            });
        }

        return $this;
    }
}
