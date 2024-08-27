<?php

namespace Rappasoft\LaravelLivewireTables\Views\Columns;

use Illuminate\Database\Eloquent\Model;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Traits\Configuration\IconColumnConfiguration;
use Rappasoft\LaravelLivewireTables\Views\Traits\Helpers\IconColumnHelpers;
use Rappasoft\LaravelLivewireTables\Views\Traits\IsColumn;

class IconColumn extends Column
{
    use IsColumn;
    use IconColumnConfiguration,
        IconColumnHelpers;

    public ?\Closure $iconCallback;

    protected string $view = 'livewire-tables::includes.columns.icon';

    public function __construct(string $title, ?string $from = null)
    {
        parent::__construct($title, $from);
        if (! isset($from)) {
            $this->label(fn () => null);
        }

        $this->html();
    }

    public function getContents(Model $row): null|string|\Illuminate\Support\HtmlString|DataTableConfigurationException|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $attributeBag = $this->getAttributeBag($row);

        return view($this->getView())
            ->withIsTailwind($this->isTailwind())
            ->withIsBootstrap($this->isBootstrap())
            ->withIcon($this->getIcon($row))
            ->withClasses($attributeBag['class'])
            ->withAttributes(collect($attributeBag)->except('class')->toArray());
    }
}
