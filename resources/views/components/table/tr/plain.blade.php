@aware(['component','isTailwind'])
@props(['customAttributes' => [], 'displayMinimisedOnReorder' => true])

@if ($isTailwind)
    <tr {{ $attributes
            ->merge($customAttributes)
            ->class(['bg-white dark:bg-gray-700 dark:text-white' => $customAttributes['default'] ?? true])
            ->class(['laravel-livewire-tables-reorderingMinimised'])
            ->except('default')
        }}
    >
        {{ $slot }}
    </tr>
@elseif ($component->isBootstrap())
    <tr {{ $attributes
            ->merge($customAttributes)
            ->class(['' => $customAttributes['default'] ?? true])
            ->class(['laravel-livewire-tables-reorderingMinimised'])
            ->except('default')
        }}
    >
        {{ $slot }}
    </tr>
@endif
