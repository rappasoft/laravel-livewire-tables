@aware(['tableName','isTailwind','isBootstrap','isBootstrap4','isBootstrap5'])
@props(['filterKey', 'filterPillData'])
<x-livewire-tables::tools.filter-pills.wrapper :$filterKey :$filterPillData :shouldWatch="true">
    {{ $filterPillData->getTitle() }}:

    @if(is_array($filterPillValues = $filterPillData->getPillValue()))
        @foreach($filterPillValues as $filterPillValue)
            {{ $filterPillValue }}{!! !$loop->last ? $separator : '' !!}
        @endforeach
    @else
        {{ $filterPillValues }}
    @endif

</x-livewire-tables::tools.filter-pills.wrapper>

