@props(['text' => null, 'customAttributes' => []])

<td {{ $attributes->merge(array_merge(['class' => 'px-3 py-2 md:px-6 md:py-3 text-left text-xs leading-4 font-medium uppercase tracking-wider bg-gray-50 text-gray-500 dark:bg-gray-800 dark:text-gray-400'], $customAttributes)) }}>
    {{ $text ?? $slot }}
</td>
