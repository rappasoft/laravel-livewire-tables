@aware(['isTailwind','isBootstrap'])
@props(['customAttributes' => [], 'displayMinimisedOnReorder' => true])

<tr {{ $attributes
        ->merge($customAttributes)
        ->class(['bg-white dark:bg-gray-700 dark:text-white' => $isTailwind && ($customAttributes['default'] ?? true)])
        ->class(['laravel-livewire-tables-reorderingMinimised'])
        ->except(['default','default-styling','default-colors'])
    }}
>
    {{ $slot }}
</tr>
