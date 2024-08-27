<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Helpers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\View\ComponentAttributeBag;
use Rappasoft\LaravelLivewireTables\Views\Traits\Columns\HasDefaultStringValue;

trait IconColumnHelpers
{
    use HasDefaultStringValue;

    public function getIcon(Model $row): string
    {
        return $this->hasIconCallback() ? app()->call($this->getIconCallback(), ['row' => $row, 'value' => $this->getValue($row) ?? '']) : ($this->getValue($row));
    }

    public function getIconCallback(): ?callable
    {
        return $this->iconCallback;
    }

    public function hasIconCallback(): bool
    {
        return isset($this->iconCallback);
    }
}
