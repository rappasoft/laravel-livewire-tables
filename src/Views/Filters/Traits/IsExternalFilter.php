<?php

namespace Rappasoft\LaravelLivewireTables\Views\Filters\Traits;

use Livewire\Attributes\Modelable;

trait IsExternalFilter
{
    #[Modelable]
    public $value = '';

    public $filterKey = '';
}
