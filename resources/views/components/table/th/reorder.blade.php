@aware(['tableName','isTailwind','isBootstrap'])

<x-livewire-tables::table.th.plain x-cloak x-show="currentlyReorderingStatus" wire:key="{{ $tableName }}-thead-reorder" :displayMinimisedOnReorder="false" {{ 
        $attributes->merge($this->getReorderThAttributes())->class([
            'table-cell px-3 py-2 md:px-6 md:py-3 text-center md:text-left bg-gray-50 dark:bg-gray-800 laravel-livewire-tables-reorderingMinimised' => ($isTailwind) && ($this->getReorderThAttributes['default'] ?? true),
            'laravel-livewire-tables-reorderingMinimised' => ($isBootstrap) && ($this->getReorderThAttributes['default'] ?? true),
        ])
    }}
>
    <div x-cloak x-show="currentlyReorderingStatus"></div>
</x-livewire-tables::table.th.plain>

