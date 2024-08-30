<div wire:key="filterComponents.{{ $filter->getKey() }}-wrapper">
    <x-livewire-tables::tools.filter-label :$filter :$filterLayout :$this->getTableName :$isTailwind :$isBootstrap4 :$isBootstrap5 :$isBootstrap />

    <livewire:dynamic-component :is="$livewireComponent" :filterKey="$filter->getKey()" :key="'filterComponents-'.$filter->getKey()" wire:model.live="filterComponents.{{ $filter->getKey() }}" />
</div>
