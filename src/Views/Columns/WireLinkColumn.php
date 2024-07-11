<?php

namespace Rappasoft\LaravelLivewireTables\Views\Columns;

use Illuminate\Database\Eloquent\Model;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Traits\Configuration\WireLinkColumnConfiguration;
use Rappasoft\LaravelLivewireTables\Views\Traits\Core\{HasActionCallback,HasConfirmation, HasTitleCallback};
use Rappasoft\LaravelLivewireTables\Views\Traits\Helpers\WireLinkColumnHelpers;

class WireLinkColumn extends Column
{
    use WireLinkColumnConfiguration,
        WireLinkColumnHelpers,
        HasActionCallback,
        HasTitleCallback,
        HasConfirmation;

    protected string $view = 'livewire-tables::includes.columns.wire-link';

    public function __construct(string $title, ?string $from = null)
    {
        parent::__construct($title, $from);

        $this->label(fn () => null);
    }

    public function getContents(Model $row): null|string|\Illuminate\Support\HtmlString|DataTableConfigurationException|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        if (! $this->hasTitleCallback()) {
            throw new DataTableConfigurationException('You must specify a title callback for a WireLink column.');
        }

        if (! $this->hasActionCallback()) {
            throw new DataTableConfigurationException('You must specify an action callback for a WireLink column.');
        }

        return view($this->getView())
            ->withColumn($this)
            ->withTitle(app()->call($this->getTitleCallback(), ['row' => $row]))
            ->withPath(app()->call($this->getActionCallback(), ['row' => $row]))
            ->withAttributes($this->hasAttributesCallback() ? app()->call($this->getAttributesCallback(), ['row' => $row]) : []);
    }
}
