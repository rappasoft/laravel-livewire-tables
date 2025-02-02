@aware(['tableName','isTailwind','isBootstrap','isBootstrap4','isBootstrap5'])
@props(['filterKey', 'filterPillData','filterPillsSeparator' => ($filterPillData->getSeparator() ?? ','), ])
<x-livewire-tables::tools.filter-pills.wrapper :$filterKey :$filterPillData :shouldWatch="true">
    {{ $filterPillData->getTitle() }}:

    @if(is_array($filterPillValues = $filterPillData->getPillValue()))
        @foreach($filterPillValues as $filterPillValue)
            {{ $filterPillValue }}{!! !$loop->last ? $filterPillsSeparator : '' !!}
        @endforeach
    @else
        {{ $filterPillValues }}
    @endif

</x-livewire-tables::tools.filter-pills.wrapper>

