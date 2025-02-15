<?php

namespace Rappasoft\LaravelLivewireTables\Views\Core;

use Illuminate\View\Component;
use Rappasoft\LaravelLivewireTables\DataTransferObjects\Filters\FilterPillData;

class Filterpill extends Component
{
    public function __construct(public FilterPillData $filterPillData)
    {

    }
    
    public function render(): null|string|\Illuminate\Support\HtmlString|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view('livewire-tables::includes.filterpill');

    }

}