@aware([ 'tableName','isTailwind','isBootstrap','isBootstrap4','isBootstrap5', 'localisationPath'])

<div {{ $attributes->merge([
        'wire:loading.class' => $this->displayFilterPillsWhileLoading ? '' : 'invisible',
        'x-cloak',
    ])
    ->class([
        'lwt-pills' => $isBootstrap,
        'mb-4 px-4 md:p-0' => $isTailwind,
    ])
}}>
    @if($isBootstrap)
        <span class="lwt-pills__label">
            {{ __($localisationPath.'Applied Filters') }}
        </span>
    @else
        <small class="text-gray-700 dark:text-white">
            {{ __($localisationPath.'Applied Filters') }}:
        </small>
    @endif

    @tableloop($this->getPillDataForFilter() as $filterKey => $filterPillData)

        @if ($filterPillData->hasCustomPillBlade)
            @include($filterPillData->getCustomPillBlade(), ['filter' => $this->getFilterByKey($filterKey), 'filterPillData' => $filterPillData])
        @else
            <x-livewire-tables::filter-pill :$filterKey :$filterPillData />
        @endif
    @endtableloop

    <x-livewire-tables::tools.filter-pills.buttons.reset-all />
</div>