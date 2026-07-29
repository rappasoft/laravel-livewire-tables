<?php

namespace Rappasoft\LaravelLivewireTables\Views\Columns;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\HtmlString;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\Traits\Configuration\ButtonGroupColumnConfiguration;
use Rappasoft\LaravelLivewireTables\Views\Columns\Traits\Helpers\ButtonGroupColumnHelpers;

class ButtonGroupColumn extends Column
{
    use ButtonGroupColumnConfiguration,
        ButtonGroupColumnHelpers;

    protected array $buttons = [];

    protected string $view = 'livewire-tables::includes.columns.button-group';

    public function __construct(string $title, ?string $from = null)
    {
        parent::__construct($title, $from);

        $this->label(fn () => null);
    }

    public function getContents(Model $row): null|string|HtmlString|DataTableConfigurationException|Application|Factory|View
    {
        return view($this->getView())
            ->withColumn($this)
            ->withRow($row)
            ->withIsTailwind($this->isTailwind())
            ->withIsBootstrap($this->isBootstrap())
            ->withButtons($this->getButtons())
            ->withAttributes($this->hasAttributesCallback() ? app()->call($this->getAttributesCallback(), ['row' => $row]) : []);
    }
}
