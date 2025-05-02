<?php

namespace Rappasoft\LaravelLivewireTables\Views\Columns;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\Traits\Configuration\LivewireComponentColumnConfiguration;
use Rappasoft\LaravelLivewireTables\Views\Columns\Traits\Helpers\LivewireComponentColumnHelpers;

class LivewireComponentColumn extends Column
{
    use LivewireComponentColumnConfiguration,
        LivewireComponentColumnHelpers;

    /**
     * The Livewire Component assigned to this Column
     */
    protected ?string $livewireComponent;

    /**
     * Gets the contents for current row
     */
    public function getContents(Model $row): null|string|HtmlString|DataTableConfigurationException|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $this->runPreChecks();

        $attributes = $this->retrieveAttributes($row);

        return $this->getHtmlString($attributes, $this->getTable().'-'.$row->{$row->getKeyName()});

    }
}
