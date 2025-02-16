<?php

namespace Rappasoft\LaravelLivewireTables\Views\Columns;

use Illuminate\Database\Eloquent\Model;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\Traits\Configuration\BooleanColumnConfiguration;
use Rappasoft\LaravelLivewireTables\Views\Columns\Traits\Helpers\BooleanColumnHelpers;
use Rappasoft\LaravelLivewireTables\Views\Traits\Core\{HasCallback,HasConfirmation};

class BooleanColumn extends Column
{
    use BooleanColumnConfiguration,
        BooleanColumnHelpers,
        HasConfirmation,
        HasCallback;

    protected string $type = 'icons';

    protected bool $successValue = true;

    protected string $view = 'livewire-tables::includes.columns.boolean';

    protected bool $isToggleable = false;

    protected ?string $toggleMethod;

    public function getContents(Model $row): null|string|\Illuminate\Support\HtmlString|DataTableConfigurationException|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        if ($this->isLabel()) {
            throw new DataTableConfigurationException('You can not specify a boolean column as a label.');
        }

        $value = $this->getValue($row);

        return view($this->getView())
            ->withRowPrimaryKey($row->{$row->getKeyName()})
            ->withIsToggleable($this->getIsToggleable())
            ->withToggleMethod($this->getIsToggleable() ? $this->getToggleMethod() : '')
            ->withHasConfirmMessage($this->hasConfirmMessage())
            ->withConfirmMessage($this->hasConfirmMessage() ? $this->getConfirmMessage() : '')
            ->withIsTailwind($this->isTailwind())
            ->withIsBootstrap($this->isBootstrap())
            ->withSuccessValue($this->getSuccessValue())
            ->withValue($value)
            ->withType($this->getType())
            ->withStatus($this->hasCallback() ? call_user_func($this->getCallback(), $value, $row) : (bool) $value === true);
    }
}
