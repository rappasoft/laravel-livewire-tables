@aware([ 'tableName','isTailwind','isBootstrap','isBootstrap4','isBootstrap5'])

<div {{ $attributes->merge([

    'wire:loading.class' => $this->displayFilterPillsWhileLoading ? '' : 'invisible',
    'x-cloak',
])
->class([
    'mb-4 px-4 md:p-0' => $isTailwind,
    'mb-3' => $isBootstrap,
])

}}>
    <small @class([
        'text-gray-700 dark:text-white' => $isTailwind,
        '' =>  $isBootstrap,
    ])>
        {{ __($this->getLocalisationPath.'Applied Filters') }}:
    </small>
    @tableloop($this->getPillDataForFilter() as $filterKey => $data)
        @php
            $filterPillValue = $data['filterPillValue'];
            $filterPillTitle = $data['filterPillTitle'];
            $filterSelectName = $data['filterSelectName'];
            $isAnExternalLivewireFilter = $data['isAnExternalLivewireFilter'];
            $separator = $data['separator'];

        @endphp
        @if ($data['filter']->hasCustomPillBlade())
            @include($data['filter']->getCustomPillBlade(), ['filter' => $data['filter']])
        @elseif($isAnExternalLivewireFilter)
            <x-livewire-tables::tools.filter-pills.external-item :$filterKey :$filterPillTitle :$filterPillValue :$filterSelectName :$separator />

        @else
            <x-livewire-tables::tools.filter-pills.item :$filterPillTitle :$filterPillValue :$filterSelectName :$separator/>
        @endif
    @endtableloop

    <x-livewire-tables::tools.filter-pills.buttons.reset-all />
</div>