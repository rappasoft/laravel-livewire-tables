<?php

namespace Rappasoft\LaravelLivewireTables\Views\Columns;

use Illuminate\Database\Eloquent\Model;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Traits\Configuration\ColorColumnConfiguration;
use Rappasoft\LaravelLivewireTables\Views\Traits\Helpers\ColorColumnHelpers;
use Rappasoft\LaravelLivewireTables\Views\Traits\IsColumn;

class ColorColumn extends Column
{
    use IsColumn;
    use ColorColumnConfiguration,
        ColorColumnHelpers;

    public string $emptyValue = '';

    protected mixed $colorCallback = null;

    protected mixed $attributesCallback = null;

    protected string $view = 'livewire-tables::includes.columns.color';

    public function __construct(string $title, ?string $from = null)
    {
        parent::__construct($title, $from);
        if (! isset($from) || $from === null) {
            $this->label(fn () => null);
        }

    }

    public function getContents(Model $row): null|string|\Illuminate\Support\HtmlString|DataTableConfigurationException|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view($this->getView())
            ->withColor($this->hasColorCallback() ? app()->call($this->getColorCallback(), ['row' => $row]) : $this->getValue($row))
            ->withAttributeBag(new \Illuminate\View\ComponentAttributeBag($this->hasAttributesCallback() ? app()->call($this->getAttributesCallback(), ['row' => $row]) : []));
    }
}
