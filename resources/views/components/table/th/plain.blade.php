@aware(['isTailwind','isBootstrap'])
@props(['displayMinimisedOnReorder' => false, 'hideUntilReorder' => false, 'customAttributes' => ['default' => true]])

<th x-cloak {{ $attributes }} scope="col"
    {{ 
        $attributes->merge($customAttributes)->class([
            'table-cell px-3 py-2 md:px-6 md:py-3 text-center md:text-left bg-gray-50 dark:bg-gray-800 laravel-livewire-tables-reorderingMinimised' => ($isTailwind) && (($customAttributes['default-colors'] ?? true) || ($customAttributes['default'] ?? true)),
            'laravel-livewire-tables-reorderingMinimised' => ($isBootstrap) && (($customAttributes['default-colors'] ?? true) || ($customAttributes['default'] ?? true)),
        ])
    }}
    @if($hideUntilReorder) :class="!reorderDisplayColumn && 'w-0 p-0 hidden'" @endif
>
    {{ $slot }}
</th>
