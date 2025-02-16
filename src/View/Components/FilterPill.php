<?php

namespace Rappasoft\LaravelLivewireTables\View\Components;

use Illuminate\View\Component;
use Rappasoft\LaravelLivewireTables\DataTransferObjects\Filters\FilterPillData;

class FilterPill extends Component
{
    public bool $shouldWatch = false;

    public function __construct(public string $filterKey, public FilterPillData $filterPillData)
    {
        $this->shouldWatch = (bool) $this->filterPillData->shouldWatchForEvents();
    }

    public function render(): null|string|\Illuminate\Support\HtmlString|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view('livewire-tables::includes.filter-pill')
            ->with([
                'filterPillsItemAttributes' => $this->filterPillData->getFilterPillsItemAttributes(),
                'pillDisplayDataArray' => $this->filterPillData->getFilterPillDisplayDataArray(),
                'pillTitleDisplayDataArray' => $this->filterPillData->getFilterTitleDisplayDataArray(),
                'setupData' => $this->filterPillData->getPillSetupData($this->filterKey, $this->shouldWatch),
            ]);

    }
}
