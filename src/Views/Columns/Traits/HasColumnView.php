<?php

namespace Rappasoft\LaravelLivewireTables\Views\Columns\Traits;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\HtmlString;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Views\Traits\Core\HasView;

trait HasColumnView
{
    use HasView;

    public function getColumnView(): null|string|HtmlString|DataTableConfigurationException|Application|Factory|View
    {
        return view($this->getView());
    }

    public function getColumnViewWithDefaults(): null|string|HtmlString|DataTableConfigurationException|Application|Factory|View
    {
        return $this->getColumnView()
            ->withIsTailwind($this->isTailwind())
            ->withIsBootstrap($this->isBootstrap())
            ->withLocalisationPath($this->getLocalisationPath());

    }
}
