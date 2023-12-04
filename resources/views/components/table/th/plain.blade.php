@aware(['component'])
@props(['displayMinimisedOnReorder' => false, 'hideUntilReorder' => false, 'customAttributes' => ['default' => true]])

<th x-cloak {{ $attributes }} scope="col"
    {{ 
        $attributes->merge($customAttributes)->class([
            'table-cell px-3 py-2 md:px-6 md:py-3 text-center md:text-left bg-gray-50 dark:bg-gray-800 laravel-livewire-tables-reorderingMinimised' => ($component->isTailwind()) && ($customAttributes['default'] ?? true),
            'laravel-livewire-tables-reorderingMinimised' => ($component->isBootstrap()) && ($customAttributes['default'] ?? true),
        ])
    }}
    @if($hideUntilReorder) :class="!reorderDisplayColumn && 'w-0 p-0 hidden'" @endif
>
    {{ $slot }}
</th>
