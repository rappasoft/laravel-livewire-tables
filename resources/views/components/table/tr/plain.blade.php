@aware(['component'])
@props(['customAttributes' => []])

@if ($component->isTailwind())
    <tr {{ $attributes
        ->merge($customAttributes)
        ->class(['bg-white dark:bg-gray-700 dark:text-white' => $customAttributes['default'] ?? true])
        ->except('default')
    }}>
        {{ $slot }}
    </tr>
@elseif ($component->isBootstrap())
    <tr {{ $attributes
        ->merge($customAttributes)
        ->class(['' => $customAttributes['default'] ?? true])
        ->except('default')
    }}>
        {{ $slot }}
    </tr>
@endif
