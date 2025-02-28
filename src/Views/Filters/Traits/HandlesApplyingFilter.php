<?php

namespace Rappasoft\LaravelLivewireTables\Views\Filters\Traits;

trait HandlesApplyingFilter
{
    use HandlesFieldName;

    protected bool $hasAppliedFilterAlready = false;

    protected function shouldApplyFilter(?string $fieldName = null): bool
    {
        if (isset($fieldName)) {
            $this->setFieldName($fieldName);
        }
        if ($this->hasFieldName()) {
            if (! $this->hasAppliedFilterAlready) {
                $this->hasAppliedFilterAlready = true;

                return true;
            } else {
                return false;
            }
        }

        return false;
    }
}
