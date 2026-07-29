<?php

namespace Rappasoft\LaravelLivewireTables\Views\Columns;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\HtmlString;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Views\Column;

class IncrementColumn extends Column
{
    protected string $view = 'livewire-tables::includes.columns.increment';

    public function __construct(string $title, ?string $from = null)
    {
        parent::__construct($title, $from);
        $this->label(fn () => null);

    }

    public function getContents(Model $row): null|string|HtmlString|DataTableConfigurationException|Application|Factory|View
    {
        return view($this->getView())
            ->withColumn($this)
            ->withAttributeBag($this->getAttributeBag($row));
    }
}
