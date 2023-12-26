<?php

namespace Rappasoft\LaravelLivewireTables\Views\Columns;

use Illuminate\Database\Eloquent\Model;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Traits\Configuration\BooleanColumnConfiguration;
use Rappasoft\LaravelLivewireTables\Views\Traits\Core\HasCallback;
use Rappasoft\LaravelLivewireTables\Views\Traits\Helpers\BooleanColumnHelpers;

class BooleanColumn extends Column
{
    use BooleanColumnConfiguration,
        BooleanColumnHelpers,
        HasCallback;

    protected string $type = 'icons';

    protected bool $successValue = true;

    protected string $view = 'livewire-tables::includes.columns.boolean';

    public function getContents(Model $row): null|string|\Illuminate\Support\HtmlString|DataTableConfigurationException|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        if ($this->isLabel()) {
            throw new DataTableConfigurationException('You can not specify a boolean column as a label.');
        }

        $value = $this->getValue($row);

        return view($this->getView())
            ->withComponent($this->getComponent())
            ->withSuccessValue($this->getSuccessValue())
            ->withType($this->getType())
            ->withStatus($this->hasCallback() ? call_user_func($this->getCallback(), $value, $row) : (bool) $value === true);
    }
}
