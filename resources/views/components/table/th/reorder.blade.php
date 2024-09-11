@aware(['tableName','isTailwind','isBootstrap'])
@php
    $customThAttributes = $this->hasReorderThAttributes() ? $this->getReorderThAttributes() : $this->getAllThAttributes($this->getReorderColumn())['customAttributes'];
@endphp

<x-livewire-tables::table.th.plain x-cloak x-show="currentlyReorderingStatus" wire:key="{{ $tableName }}-thead-reorder" :displayMinimisedOnReorder="false" 
    {{ 
        $attributes->merge($customThAttributes)
            ->class(['text-gray-500 dark:bg-gray-800 dark:text-gray-400' => ($customThAttributes['default-colors'] ?? true || $customThAttributes['default'] ?? true)])
            ->class(['table-cell px-6 py-3 text-left text-xs font-medium whitespace-nowrap uppercase tracking-wider' => ($customThAttributes['default-styling'] ?? true || $customThAttributes['default'] ?? true)])
            ->class(['laravel-livewire-tables-reorderingMinimised' => ($isBootstrap) && ($customThAttributes['default'] ?? true)])
    }}
>
    <div x-cloak x-show="currentlyReorderingStatus"></div>
</x-livewire-tables::table.th.plain>

