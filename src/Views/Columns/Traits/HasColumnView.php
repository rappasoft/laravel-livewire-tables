<?php

namespace Rappasoft\LaravelLivewireTables\Views\Columns\Traits;

use Rappasoft\LaravelLivewireTables\Views\Traits\Core\HasView;

trait HasColumnView
{
    use HasView;

    public function getColumnView(): null|string|\Illuminate\Support\HtmlString|\Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view($this->getView());
    }

    public function getColumnViewWithDefaults(): null|string|\Illuminate\Support\HtmlString|\Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return $this->getColumnView()
            ->withIsTailwind($this->isTailwind())
            ->withIsBootstrap($this->isBootstrap())
            ->withLocalisationPath($this->getLocalisationPath());

    }
}
