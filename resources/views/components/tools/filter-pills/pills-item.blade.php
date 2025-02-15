@aware(['tableName','isTailwind','isBootstrap4','isBootstrap5'])
@props([
    'filterKey', 
    'filterPillData', 
    ])

<x-livewire-tables::filter-pill :$filterKey :$filterPillData />

