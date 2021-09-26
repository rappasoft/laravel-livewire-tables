@props(['customAttributes' => []])

<td {{ $attributes->merge(['class' => 'px-3 py-2 md:px-6 md:py-4 text-sm leading-5 text-gray-900 dark:text-white'])->merge(['class' => $this->responsive ? 'whitespace-nowrap' : ''])->merge($customAttributes) }}>
    {{ $slot }}
</td>
