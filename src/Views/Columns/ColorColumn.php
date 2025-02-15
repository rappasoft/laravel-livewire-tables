<?php

namespace Rappasoft\LaravelLivewireTables\Views\Columns;

use Closure;
use Illuminate\Database\Eloquent\Model;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\Traits\HasDefaultStringValue;
use Rappasoft\LaravelLivewireTables\Views\Columns\Traits\Configuration\ColorColumnConfiguration;
use Rappasoft\LaravelLivewireTables\Views\Columns\Traits\Helpers\ColorColumnHelpers;

class ColorColumn extends Column
{
    use ColorColumnConfiguration,
        ColorColumnHelpers,
        HasDefaultStringValue;

    public ?Closure $colorCallback;

    protected string $view = 'livewire-tables::includes.columns.color';

    public function __construct(string $title, ?string $from = null)
    {
        parent::__construct($title, $from);
        if (! isset($from)) {
            $this->label(fn () => null);
        }

    }

    public function getContents(Model $row): null|string|\Illuminate\Support\HtmlString|DataTableConfigurationException|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return $this->getColumnViewWithDefaults()
            ->withColor($this->getColor($row))
            ->withAttributeBag($this->getAttributeBag($row));
    }

    public function getValue(Model $row): string
    {
        return parent::getValue($row) ?? $this->getDefaultValue();
    }

}
