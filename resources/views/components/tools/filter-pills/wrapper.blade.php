@aware(['tableName','isTailwind','isBootstrap','isBootstrap4','isBootstrap5'])
@props(['filterKey', 'filterPillData', 'filterPillsItemAttributes' => $filterPillData->getFilterPillsItemAttributes()])

<span 
        wire:key="{{ $tableName }}-filter-pill-{{ $filterKey }}" {{
        $attributes->merge($filterPillsItemAttributes)
        ->class([
            'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium leading-4 capitalize' => $isTailwind && $filterPillsItemAttributes['default-styling'],
            'bg-indigo-100 text-indigo-800 dark:bg-indigo-200 dark:text-indigo-900' => $isTailwind && $filterPillsItemAttributes['default-colors'],
            'badge badge-pill badge-info d-inline-flex align-items-center' => $isBootstrap4 && $filterPillsItemAttributes['default-styling'],
            'badge rounded-pill bg-info d-inline-flex align-items-center' => $isBootstrap5 && $filterPillsItemAttributes['default-styling'],
        ])
        ->except(['default-styling', 'default-colors'])
    }}
>
    {{ $slot }}

    <x-livewire-tables::tools.filter-pills.buttons.reset-filter :$filterKey />

</span>
