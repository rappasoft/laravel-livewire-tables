<?php

namespace Rappasoft\LaravelLivewireTables\Views\Columns;

use Illuminate\Database\Eloquent\Model;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Traits\Configuration\BooleanColumnConfiguration;
use Rappasoft\LaravelLivewireTables\Views\Traits\Helpers\BooleanColumnHelpers;

class BooleanColumn extends Column
{
    use BooleanColumnConfiguration,
        BooleanColumnHelpers;

    protected bool $successValue = true;
    protected string $view = 'livewire-tables::includes.columns.boolean';
    protected $callback;

    public function getContents(Model $row)
    {
        if ($this->isLabel()) {
            throw new DataTableConfigurationException('You can not specify a boolean column as a label.');
        }

        $value = $this->getValue($row);

        return view($this->getView())
            ->withComponent($this->getComponent())
            ->withSuccessValue($this->getSuccessValue())
            ->withStatus($this->hasCallback() ? app()->call($this->getCallback(), ['value' => $value]) : (bool)$value === true);
    }
}
