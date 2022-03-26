@props(['customAttributes' => []])

<td {{ $attributes->merge(['class' => 'p-2 md:p-4 text-sm leading-5 text-gray-900 dark:text-white'])->merge(['class' => $this->responsive ? 'whitespace-nowrap' : ''])->merge($customAttributes) }}>
    {{ $slot }}
</td>
