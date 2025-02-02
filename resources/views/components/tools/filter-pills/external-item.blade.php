@aware(['tableName','isTailwind','isBootstrap','isBootstrap4','isBootstrap5'])
@props(['filterKey', 'filterPillData','filterPillsSeparator' => ($filterPillData->getSeparator() ?? ','), ])

<x-livewire-tables::tools.filter-pills.wrapper :$filterKey :$filterPillData x-data="filterPillsGeneric('{{ $filterKey }}', '{{ $filterPillsSeparator }}', true)" >
        {{ $filterPillData->getTitle() }}:
    <div class="flex flex-col space-y-2"  >
        <span x-text="localFilterPillValues"></span>
    </div>
</x-livewire-tables::tools.filter-pills.wrapper>
