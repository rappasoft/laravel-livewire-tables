<?php

namespace Rappasoft\LaravelLivewireTables\Views\Columns\Traits\Helpers;

use Illuminate\Database\Eloquent\Model;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Views\Columns\Traits\HasDefaultStringValue;

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
