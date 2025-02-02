@aware(['tableName','isTailwind','isBootstrap','isBootstrap4','isBootstrap5'])
@props(['filterKey', 'filterPillData'])
<x-livewire-tables::tools.filter-pills.wrapper :$filterKey :$filterPillData :shouldWatch="true">
    {{ $filterPillData->getTitle() }}:

    {{ $filterPillData->getValueFromPillData() }}

</x-livewire-tables::tools.filter-pills.wrapper>

