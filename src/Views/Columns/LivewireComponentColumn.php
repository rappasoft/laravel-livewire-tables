<?php

namespace Rappasoft\LaravelLivewireTables\Views\Columns;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Traits\Configuration\LivewireComponentColumnConfiguration;
use Rappasoft\LaravelLivewireTables\Views\Traits\Helpers\LivewireComponentColumnHelpers;

class LivewireComponentColumn extends Column
{
    use LivewireComponentColumnConfiguration,
        LivewireComponentColumnHelpers;

    protected ?string $livewireComponent;
}
