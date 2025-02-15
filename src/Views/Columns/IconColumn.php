<?php

namespace Rappasoft\LaravelLivewireTables\Views\Columns;

use Closure;
use Illuminate\Database\Eloquent\Model;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\Traits\Configuration\IconColumnConfiguration;
use Rappasoft\LaravelLivewireTables\Views\Columns\Traits\Helpers\IconColumnHelpers;

class IconColumn extends Column
{
    use IconColumnConfiguration,
        IconColumnHelpers;

    public ?Closure $iconCallback;

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

        return $this->getColumnViewWithDefaults()
            ->withIcon($this->getIcon($row))
            ->withClasses($attributeBag['class'])
            ->withAttributes(collect($attributeBag)->except('class')->toArray());
    }
}
